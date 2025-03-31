<template>
    <div class="flex flex-row items-center gap-2">
        <span v-for="(tag, index) in formattedTags" :key="index">
            <Badge variant="secondary">
                {{ tag.trim().charAt(0).toUpperCase() + tag.trim().slice(1) }}
            </Badge>
        </span>
    </div>
</template>

<script setup lang="ts">
    import Badge from '@/components/ui/badge/Badge.vue';

    import { defineProps, computed } from 'vue';

    const props = defineProps({
        tags: {
            type: String,
            required: true
        }
    });

    const formattedTags = computed(() => {
        if(!props.tags) {
            return [];
        }
        return props.tags.split(',').map(tag => {
            return tag.trim().charAt(0).toUpperCase() + tag.trim().slice(1);
        });
    });
</script>