<template>
    <h2>{{ title }}</h2>
    <div class="flex flex-col mt-4">
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
    import { defineProps } from 'vue';

    const props = defineProps({
    title: {
        type: String,
        required: true
    }
    });
</script>