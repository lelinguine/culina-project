<template>
  <Dialog v-model:open="isDialogOpen">
    <DialogTrigger as-child>
      <Button variant="secondary" @click="onDialogOpen">
        <component :is="PenLine" /> Ecrire
      </Button>
    </DialogTrigger>
    <DialogContent class="w-[400px]">
      <DialogHeader class="mb-4">
        <DialogTitle>Ajouter un commentaire</DialogTitle>
        <DialogDescription>
          Entrez votre commentaire ci-dessous.
        </DialogDescription>
      </DialogHeader>
      <form @submit="onAddComment" class="grid gap-4">
        <FormField v-slot="{ componentField }" name="comment">
          <FormItem class="flex flex-col gap-2">
            <Label for="comment">Commentaire</Label>
            <FormControl>
              <textarea id="comment" v-bind="componentField" class="p-2 border rounded-md h-24 resize-none"></textarea>
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>
        <DialogFooter class="mt-2">
          <Button type="submit" variant="secondary">
            <component :is="PenLine" /> Ecrire
          </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>

<script setup lang="ts">
  import { Button } from '@/components/ui/button';
  import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
  } from '@/components/ui/dialog';
  import { Label } from '@/components/ui/label';
  import { PenLine } from "lucide-vue-next";
  import { ref, defineProps } from 'vue';

  import { useForm } from 'vee-validate';
  import { toTypedSchema } from '@vee-validate/zod';
  import * as z from 'zod';

  import {
    FormControl,
    FormField,
    FormItem,
    FormMessage,
  } from '@/components/ui/form';

  import useCommentController from '@/controllers/CommentController';
  const { addComment } = useCommentController();

  const isDialogOpen = ref(false);

  const props = defineProps({
    recipe_id: {
      type: Number,
      required: true,
    }
  });

  const formSchema = toTypedSchema(
    z.object({
      comment: z.string().min(1, "Requis"),
    })
  );

  const form = useForm({
    validationSchema: formSchema,
    initialValues: {
      comment: '',
    },
  });

  const onDialogOpen = () => {
    form.setValues({ comment: '' });
  };

  const onAddComment = form.handleSubmit(async (values) => {
    await addComment(props.recipe_id, values.comment);
    isDialogOpen.value = false;
  });
</script>
