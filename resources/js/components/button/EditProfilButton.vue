<template>
  <Dialog v-model:open="isDialogOpen">
    <DialogTrigger as-child>
      <Button variant="secondary" @click="onDialogOpen">
        <component :is="Pencil" /> Modifier
      </Button>
    </DialogTrigger>
    <DialogContent class="w-[400px]">
      <DialogHeader class="mb-4">
        <DialogTitle>Modifier mes informations</DialogTitle>
        <DialogDescription>
          Apportez des modifications à votre profil.
        </DialogDescription>
      </DialogHeader>
      <form @submit="onEdit" class="grid gap-4">
        <FormField v-slot="{ componentField }" name="name">
          <FormItem class="flex flex-col">
            <div class="flex flex-row items-center gap-4 w-full">
              <Label for="name">Nom</Label>
              <FormControl>
                <Input id="name" v-bind="componentField" />
              </FormControl>
            </div>
            <FormMessage />
          </FormItem>
        </FormField>

        <DialogFooter class="mt-2">
          <Button type="submit" variant="secondary">
            <component :is="Pen" /> Modifier
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
  
  import { useForm } from 'vee-validate';
  import { toTypedSchema } from '@vee-validate/zod';
  import * as z from 'zod';
  
  import {
    FormControl,
    FormField,
    FormItem,
    FormMessage,
  } from '@/components/ui/form';

  // -------------------------------- State --------------------------------
  import { useStateStore } from '@/stores/stateStore';
  const stateStore = useStateStore();

  import { ref } from 'vue';
  const name = ref(stateStore.user.name);

  // -------------------------------- Validation --------------------------------
  const formSchema = toTypedSchema(
    z.object({
      name: z.string().min(1, "Requis"),
    })
  );

  const form = useForm({
    validationSchema: formSchema,
    initialValues: {
      name: name.value,
    },
  });

  // -------------------------------- Register --------------------------------
  import useUserController from '@/controllers/UserController';
  const { editProfile } = useUserController();

  const isDialogOpen = ref(false);

  const onDialogOpen = () => {
    form.setValues({
      name: name.value,
    });
  };

  const onEdit = form.handleSubmit(async (values) => {
    name.value = values.name;

    await editProfile(name.value);
    stateStore.setNotification("editProfile");
    isDialogOpen.value = false;
  });
</script>
