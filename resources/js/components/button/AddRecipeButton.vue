<template>
  <Dialog v-model:open="isDialogOpen">
    <DialogTrigger as-child>
      <Button variant="secondary" @click="onDialogOpen">
        <component :is="CirclePlus" /> Créer
      </Button>
    </DialogTrigger>
    <DialogContent class="w-[400px]">
      <DialogHeader class="mb-4">
        <DialogTitle>Ajouter une nouvelle recette</DialogTitle>
        <DialogDescription>
          Remplissez les champs pour créer une nouvelle recette.
        </DialogDescription>
      </DialogHeader>
      <form @submit="onCreate" class="grid gap-4">
        <!-- Champ Titre -->
        <FormField v-slot="{ componentField }" name="title">
          <FormItem class="flex flex-col">
            <Label for="title">Titre</Label>
            <FormControl>
              <Input id="title" v-bind="componentField" />
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <!-- Champ Media -->
        <div class="flex flex-col gap-2">
          <Label for="image">Media</Label>
          <Input type="file" @change="handleFileUpload" accept="image/*" />
          <!-- Affichage de l'erreur si le fichier n'est pas une image -->
          <span v-if="fileError" class="text-red-500 text-sm">{{ fileError }}</span>
          <!-- Aperçu de l'image -->
          <div v-if="imageUrl">
            <img :src="imageUrl" class="w-32 rounded-md border" />
          </div>
        </div>

        <!-- Champ Contenu -->
        <FormField v-slot="{ componentField }" name="content">
          <FormItem class="flex flex-col gap-2">
            <Label for="content">Contenu</Label>
            <FormControl>
              <textarea id="content" v-bind="componentField" class="p-2 border rounded-md h-32 resize-none"></textarea>
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <!-- Champ Tags -->
        <FormField v-slot="{ componentField }" name="tags">
          <FormItem class="flex flex-col">
            <Label for="tags">Tags</Label>
            <FormControl>
              <Input id="tags" v-bind="componentField" />
            </FormControl>
            <span class="text-sm text-gray-500">Séparez les tags par des virgules.</span>
            <FormMessage />
          </FormItem>
        </FormField>

        <!-- Bouton Créer -->
        <DialogFooter class="mt-2">
          <Button type="submit" variant="secondary">
            <component :is="CirclePlus" /> Créer
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
import { CirclePlus } from "lucide-vue-next";
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
import useRecipeController from '@/controllers/RecipeController';

const { createRecipe, uploadMedia } = useRecipeController();

const isDialogOpen = ref(false);
const imageFile = ref<File | null>(null);
const imageUrl = ref<string | null>(null);
const fileError = ref<string | null>(null);

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
    title: '',
    content: '',
    tags: '',
  },
});

const handleFileUpload = async (event: Event) => {
  const target = event.target as HTMLInputElement;
  const file = target.files?.[0];
  
  if (!file) return;

  // Vérification du type de fichier
  if (!file.type.startsWith("image/")) {
    fileError.value = "Le fichier doit être une image (jpg, png, webp, etc.)";
    return;
  }

  fileError.value = null; // Réinitialiser l'erreur si le fichier est valide
  imageFile.value = file;

  const formData = new FormData();
  formData.append("image", file);

  imageUrl.value = await uploadMedia(formData);
};

const onDialogOpen = () => {
  form.setValues({ title: '', content: '', tags: '' });
  imageUrl.value = null;
  imageFile.value = null;
  fileError.value = null; // Réinitialiser l'erreur
};

const onCreate = form.handleSubmit(async (values) => {
  const newRecipe = {
    title: values.title,
    content: values.content,
    tags: values.tags,
    media: imageUrl.value,
  };

  await createRecipe(newRecipe);
  isDialogOpen.value = false;
});
</script>
