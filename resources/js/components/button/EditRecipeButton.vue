<template>
  <Dialog v-model:open="isDialogOpen">
    <DialogTrigger as-child>
      <Button variant="secondary" @click="onDialogOpen">
        <component :is="Pencil" /> Modifier
      </Button>
    </DialogTrigger>
    <DialogContent class="w-[400px]">
      <DialogHeader class="mb-4">
        <DialogTitle>Modifier la recette</DialogTitle>
        <DialogDescription>
          Apportez des modifications à votre recette.
        </DialogDescription>
      </DialogHeader>
      <form @submit="onEdit" class="grid gap-4">
        <FormField v-slot="{ componentField }" name="title">
          <FormItem class="flex flex-col">
            <div class="flex flex-row items-center gap-4 w-full">
              <Label for="title">Titre</Label>
              <FormControl>
                <Input id="title" v-bind="componentField" />
              </FormControl>
            </div>
            <FormMessage />
          </FormItem>
        </FormField>

        <div class="flex flex-col gap-2">
          <Label for="image">Media</Label>
          <Input type="file" @change="handleFileUpload" accept="image/*" />
          <span v-if="fileError" class="text-red-500 text-sm">{{ fileError }}</span>
          <div v-if="imageUrl">
            <img :src="imageUrl" class="w-32 rounded-md border" />
          </div>
        </div>

        <FormField v-slot="{ componentField }" name="content">
          <FormItem class="flex flex-col gap-2">
            <Label for="content">Contenu</Label>
            <FormControl>
              <textarea id="content" v-bind="componentField" class="col-span-3 p-2 border rounded-md h-32 resize-none">{{ props.recipe.content }}</textarea>
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <FormField v-slot="{ componentField }" name="tags">
          <FormItem class="flex flex-col">
            <div class="flex flex-row items-center gap-4 w-full">
              <Label for="tags">Tags</Label>
              <FormControl>
                <Input id="tags" v-bind="componentField" />
              </FormControl>
            </div>
            <span class="text-sm text-gray-500">Séparez les tags par des virgules.</span>
            <FormMessage />
          </FormItem>
        </FormField>

        <DialogFooter class="mt-2">
          <Button type="submit" variant="secondary">
            <component :is="Pencil" /> Modifier
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
  import { Input } from '@/components/ui/input';
  import { Label } from '@/components/ui/label';
  import { Pencil } from "lucide-vue-next";
  import { ref } from 'vue';

  import { useForm } from 'vee-validate';
  import { toTypedSchema } from '@vee-validate/zod';
  import * as z from 'zod';

  import {
    FormControl,
    FormField,
    FormItem,
    FormMessage,
  } from '@/components/ui/form';

  const props = defineProps({
    recipe: {
      type: Object,
      required: true
    }
  });

  const formSchema = toTypedSchema(
    z.object({
      title: z.string().min(1, "Requis"),
      content: z.string().min(1, "Requis"),
      tags: z.string().min(1, "Requis"),
    })
  );

  const form = useForm({
    validationSchema: formSchema,
    initialValues: {
      title: props.recipe.title,
      content: props.recipe.content,
      tags: props.recipe.tags,
    },
  });

  import useRecipeController from '@/controllers/RecipeController';
  const { editRecipe, uploadMedia } = useRecipeController();

  const isDialogOpen = ref(false);
  const imageFile = ref<File | null>(null);
  const imageUrl = ref<string | null>(null);
  const fileError = ref<string | null>(null);

  const handleFileUpload = async (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0];
    if (!file) return;

    // Vérifier si c'est bien une image
    if (!file.type.startsWith("image/")) {
      fileError.value = "Le fichier doit être une image (jpg, png, webp, etc.)";
      return;
    }

    fileError.value = null; // Reset l'erreur si l'image est valide
    imageFile.value = file;
    
    const formData = new FormData();
    formData.append("image", file);

    imageUrl.value = await uploadMedia(formData);
  };

  const onDialogOpen = () => {
    form.setValues({
      title: props.recipe.title,
      content: props.recipe.content,
      tags: props.recipe.tags,
    });
    imageUrl.value = props.recipe.media;
    fileError.value = null;
  };

  const onEdit = form.handleSubmit(async (values) => {
    props.recipe.title = values.title;
    props.recipe.content = values.content;
    props.recipe.tags = values.tags;
    props.recipe.media = imageUrl.value;

    await editRecipe(props.recipe);
    isDialogOpen.value = false;
  });
</script>
