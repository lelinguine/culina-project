<template>

    <Command class="rounded-lg border shadow-md max-w-[80%]">
        <CommandInput v-model="searchQuery" placeholder="Recherche" />
        <CommandList>
            <CommandGroup v-if="searchResults.length" heading="Suggestions">
                <CommandItem 
                    v-for="recipe in searchResults" 
                    :key="recipe.id" 
                    :value="recipe.title" 
                    @click="selectRecipe(recipe)"
                    class="cursor-pointer"
                >
                    {{ recipe.title }}
                </CommandItem>
            </CommandGroup>
            <CommandSeparator v-if="searchResults.length" />
            <CommandEmpty class="text-gray-500 text-xs">Aucun résultat trouvé.</CommandEmpty>
        </CommandList>
    </Command>

</template>

<script setup lang="ts">
    import {
        Command,
        CommandEmpty,
        CommandGroup,
        CommandInput,
        CommandItem,
        CommandList,
        CommandSeparator
    } from '@/components/ui/command'

    import { ref, computed, defineProps } from 'vue';

    const props = defineProps({
        recipes: {
            type: Array,
            required: true
        }
    });

    const searchQuery = ref<string>('');

    const searchResults = computed(() => {
        const query = searchQuery.value.trim().toLowerCase();
        if (!query) return [];

        return props.recipes.filter(recipe => {
            const title = recipe.title?.toLowerCase() || '';
            const tags = Array.isArray(recipe.tags) ? recipe.tags.join(', ').toLowerCase() : recipe.tags?.toLowerCase() || '';

            return title.includes(query) || tags.includes(query);
        });
    });

    import { useRouter } from 'vue-router';
    const router = useRouter();

    const selectRecipe = (recipe: any) => {
        router.push(`/app/explore/${recipe.id}`);
    }
</script>