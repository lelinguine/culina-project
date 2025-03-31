<script setup lang="ts">
  import { ref } from 'vue';
  import axios from 'axios';

  import { Button } from '@/components/ui/button'
  import {
    FormControl,
    FormField,
    FormItem,
    FormMessage,
  } from '@/components/ui/form'
  import { Input } from '@/components/ui/input'

  import { Eye, EyeOff } from "lucide-vue-next"

  // -------------------------------- Color Mode --------------------------------
  import { useColorMode } from '@vueuse/core'
  const mode = useColorMode();

  // -------------------------------- Form Validation --------------------------------
  import { useForm } from 'vee-validate';
  import { toTypedSchema } from '@vee-validate/zod';
  import * as z from 'zod';

  const formSchema = toTypedSchema(
    z.object({
      name: z.string().min(1, "Requis"),
      mail: z.string().regex(/^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Format invalide"),
      password: z.string().min(3, "Requis"),
    })
  );

  const form = useForm({
    validationSchema: formSchema,
  });

  const errorMessage = ref('');
  const showPassword = ref(false);
  const togglePassword = () => {
    showPassword.value = !showPassword.value;
  };

  // -------------------------------- Login --------------------------------
  import useUserController from '@/controllers/UserController';
  const { register } = useUserController();

  const onSubmit = form.handleSubmit(async (values) => {    
    await register(values.name, values.mail, values.password, errorMessage);
  });
</script>

<template>
  <div class="relative flex flex-col items-center justify-center min-h-screen">
    <div class="flex flex-col justify-center gap-2 w-[400px]">
      <div class="flex flex-col justify-center mb-10 gap-2">
        <h1 class="text-2xl font-semibold leading-none">Créez votre compte Culina</h1>
        <span class="flex items-center space-x-3 text-gray-500">Rejoignez-nous dès aujourd'hui !</span>
      </div>

      <form @submit="onSubmit" class="flex flex-col gap-5">

        <!-- Name -->
        <FormField v-slot="{ componentField }" name="name">
          <FormItem>
            <FormControl>
              <Input 
                type="text"
                placeholder="Nom"
                v-bind="componentField"
              />
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <!-- Email -->
        <FormField v-slot="{ componentField }" name="mail">
          <FormItem>
            <FormControl>
              <Input 
                type="mail"
                placeholder="Adresse mail"
                v-bind="componentField"
              />
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <!-- Password -->
        <FormField v-slot="{ componentField }" name="password">
          <FormItem>
            <FormControl>
              <div class="relative flex items-center gap-4">
                <Input 
                  :type="showPassword ? 'text' : 'password'" 
                  placeholder="Mot de passe"
                  v-bind="componentField"
                />
                <Button variant="secondary" type="button" @click="togglePassword">
                  <component :is="showPassword ? Eye : EyeOff" />
                </Button>
              </div>
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <!-- Submit Button -->
        <div class="flex flex-col gap-2">
          <Button type="submit">S'inscrire</Button>
          <p v-if="errorMessage" class="text-red-500 text-xs">{{ errorMessage }}</p>
        </div>
      </form>

      <div class="mt-2 flex flex-col gap-2">
        <span class="text-gray-500 text-xs">Vous avez déjà un compte ?</span>
        <Button variant="secondary">
          <router-link to="/login">Se connecter</router-link>
        </Button>
      </div>
    </div>
  </div>
</template>
