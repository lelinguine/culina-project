<template>
    <div class="flex items-center justify-between">
      <BackButton v-if="isBack" />
      <div></div>
      <div class="flex items-center justify-center gap-2">
        <slot></slot>
      </div>
    </div>
</template>

<script setup lang="ts">
  import BackButton from '@/components/button/BackButton.vue';

  import { defineProps } from 'vue';

  const props = defineProps({
    isBack: {
      type: Boolean,
      default: true
    }
  });
</script>