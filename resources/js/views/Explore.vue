<template>
    <Header title="Explorer" subtitle="Découvrez des recettes savoureuses et faciles à réaliser.">
        <SearchBar v-if="recipes" :recipes="recipes" />
    </Header>
    <View title="Découvrir">
        <FiltersList :recipes="recipes" :toggleFilter="toggleFilter" :resetFilters="resetFilters" :selectedFilters="selectedFilters" v-if="recipes" />
    </View>
    <View title="">
        <RecipesList :filteredRecipes="filteredRecipes" v-if="recipes" />
    </View>
</template>

<script setup lang="ts">
    import Header from '@/components/Header.vue';
    import View from '@/components/View.vue';

    import SearchBar from '@/components/SearchBar.vue';
    import FiltersList from '@/components/list/FiltersList.vue';
    import RecipesList from '@/components/list/RecipesList.vue';
    
    import { ref, computed, onMounted } from 'vue'

    const selectedFilters = ref<Array<string>>([])

    const toggleFilter = (filter: string) => {
        if (selectedFilters.value.includes(filter)) {
            selectedFilters.value = selectedFilters.value.filter(f => f !== filter)
        } else {
            selectedFilters.value.push(filter)
        }
    }

    const resetFilters = () => {
        selectedFilters.value = []
    }

    const filteredRecipes = computed(() => {
        let filtered = recipes.value

        if (selectedFilters.value.length > 0) {
            filtered = filtered.filter(recipe =>
                selectedFilters.value.every(filter => recipe.tags.includes(filter))
            )
        }

        return filtered
    })

    // -------------------------------- Fetch recipes --------------------------------
    import useRecipeController from '@/controllers/RecipeController';
    const { fetchRecipes } = useRecipeController();

    const recipes = ref<Array<any>>([])

    onMounted( async () => {
        recipes.value = await fetchRecipes();
    })
</script>