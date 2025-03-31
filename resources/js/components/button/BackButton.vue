<template>
    <Button @click="goBack">
        <component :is="Undo2" />Retour
    </Button>
</template>

<script setup lang="ts">
  import { Undo2 } from "lucide-vue-next"
  import Button from '@/components/ui/button/Button.vue';

  import { useRouter } from "vue-router"
  
  const router = useRouter()

  const goBack = () => {
    router.go(-1);
  };
</script>