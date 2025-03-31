<script setup lang="ts">
  import { SidebarProvider } from "@/components/ui/sidebar";
  import AppSidebar from "@/components/ui/AppSidebar.vue";

  import { onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  const router = useRouter();

  // -------------------------------- Login --------------------------------
  import useLoginController from '@/controllers/LoginController';
  const { session } = useLoginController();

  onMounted(() => {
      session();
      if (router.currentRoute.value.path === "/app") {
          router.push("/app/explore");
      }
  });
</script>

<template>
  <SidebarProvider>
    <AppSidebar />
    
    <main class="m-4 w-screen">
      <router-view />
    </main>
    
  </SidebarProvider>
</template>