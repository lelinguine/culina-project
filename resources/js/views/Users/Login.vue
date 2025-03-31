<script setup lang="ts">
  // -------------------------------- Color Mode --------------------------------
  import { useColorMode } from '@vueuse/core'
  const mode = useColorMode();

  // -------------------------------- Form --------------------------------
  import { Eye, EyeOff } from "lucide-vue-next"
  import { Button } from '@/components/ui/button'
  import {
    FormControl,
    FormField,
    FormItem,
    FormMessage,
  } from '@/components/ui/form'
  import { Input } from '@/components/ui/input'

  // -------------------------------- Hide password --------------------------------
  const showPassword = ref(false)
  const togglePassword = () => {
    showPassword.value = !showPassword.value
  }

  // -------------------------------- Validation --------------------------------
  import { useForm } from 'vee-validate'
  import { toTypedSchema } from '@vee-validate/zod'
  import * as z from 'zod'

  const formSchema = toTypedSchema(
    z.object({
      mail: z.string()
        .regex(/^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Format invalide"),
      password: z.string().min(1, "Requis"),
    })
  )

  const form = useForm({
    validationSchema: formSchema,
  })

  // -------------------------------- Login --------------------------------
  import useLoginController from '@/controllers/LoginController';
  const { login } = useLoginController();

  const onSubmit = form.handleSubmit(async (values) => {
      await login(values.mail, values.password, errorMessage);
  });
  import { ref } from 'vue'
  const errorMessage = ref("");

  // -------------------------------- Google --------------------------------
  import GoogleLogin from '@/components/GoogleLogin.vue'
</script>

<template>
  <div class="relative flex flex-col items-center justify-center min-h-screen">
    <div class="flex flex-col justify-center gap-2 w-[400px]">
      <div class="flex flex-col justify-center mb-10 gap-2">
        <h1 class="text-2xl font-semibold leading-none">Connectez-vous à Culina</h1>
        <span class="flex items-center space-x-3 text-gray-500">Heureux de vous revoir !</span>
      </div>

      <div class="flex flex-col gap-2">
        <GoogleLogin />
      </div>

      <div class="flex items-center justify-center flex-col gap-2 m-2">
        <span class="text-gray-500 text-xs">ou</span>
      </div>

      <form @submit="onSubmit" class="flex flex-col gap-5">

        <div class="flex flex-col gap-4 items-center">

          <FormField v-slot="{ componentField }" name="mail">
            <FormItem class="w-full">
              <FormControl>
                <Input type="text" placeholder="Adresse mail" v-bind="componentField"/>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="password">
            <FormItem class="w-full">
              <FormControl>
                <div class="flex items-center gap-4">
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

        </div>

        <div class="flex flex-col gap-2">
          <Button type="submit">Se connecter</Button>
          <p v-if="errorMessage" class="text-red-500 text-xs">{{ errorMessage }}</p>
        </div>
      </form>

      <div class="mt-2 flex flex-col gap-2">
        <span class="text-gray-500 text-xs">Vous n'avez pas de compte ?</span>
        <Button variant="secondary">
          <router-link to="/register">Créer un compte</router-link>
        </Button>
      </div>
    </div>
  </div>
</template>