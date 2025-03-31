<template>
    <div class="flex flex-col justify-center items-center mt-10 gap-2">
        <h1 class="text-2xl font-semibold leading-none">{{ title }}</h1>
        <h2 class="text-gray-500">{{ subtitle }}</h2>
    </div>

    <div class="flex flex-col justify-center items-center mt-10 mb-20 gap-4">
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
    import { defineProps, computed } from 'vue';

    const props = defineProps({
        title: {
            type: String,
            required: true
        },
        subtitle: {
            type: String,
            required: true
        }
    });
</script>