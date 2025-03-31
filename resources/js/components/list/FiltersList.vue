<template>
    <div class="flex flex-col">
        <div class="flex flex-wrap items-center gap-2 text-xs w-full">
            <span class="text-gray-500 whitespace-nowrap">Filtres :</span>
            <Badge 
                :variant="selectedFilters.length === 0 ? 'default' : 'secondary'"
                @click="resetFilters()"
                class="cursor-pointer"
            >
                Tout
            </Badge>
            <Badge 
                v-for="(filter, index) in availableFilters"
                :key="index"
                :variant="selectedFilters.includes(filter) ? 'default' : 'secondary'"
                @click="toggleFilter(filter)"
                class="cursor-pointer"
            >
            {{ filter.charAt(0).toUpperCase() + filter.slice(1) }}
            </Badge>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { ref, computed, defineProps } from 'vue';
    import Badge from '@/components/ui/badge/Badge.vue';

    const props = defineProps({
        recipes: {
            type: Array,
            required: true
        },
        toggleFilter: {
            type: Function,
            required: true
        },
        resetFilters: {
            type: Function,
            required: true
        },
        selectedFilters: {
            type: Array,
            required: true
        }
    });

    const availableFilters = computed(() => {
        const allTags = new Set<string>();

        props.recipes.forEach(recipe => {
            if (Array.isArray(recipe.tags)) {
            recipe.tags.forEach(tag => allTags.add(tag.trim()));
            } else if (typeof recipe.tags === "string") {
            recipe.tags.split(',').forEach(tag => allTags.add(tag.trim()));
            }
        });

        return Array.from(allTags).sort(() => Math.random() - 0.5).slice(0, 8);
    });
</script>