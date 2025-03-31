<template>
    <HeadBar :isBack="false">
        <AddRecipeButton />
    </HeadBar>

    <Header title="Partagés" subtitle="Retrouvez ici toutes les recettes que vous avez partagé.">
    </Header>

    <View title="Mes recettes">
        <RecipesList :filteredRecipes="recipes" v-if="recipes" />
    </View>
</template>

<script setup lang="ts">
    import Header from '@/components/Header.vue';
    import View from '@/components/View.vue';
    import HeadBar from '@/components/HeadBar.vue';

    import AddRecipeButton from '@/components/button/AddRecipeButton.vue';
    import RecipesList from '@/components/list/RecipesList.vue';

    import { onMounted, ref } from 'vue';
    // -------------------------------- Fetch recipes --------------------------------
    import useRecipeController from '@/controllers/RecipeController';
    const { fetchShared } = useRecipeController();

    const recipes = ref<Array<any>>([])

    onMounted( async () => {
        recipes.value = await fetchShared();
    })
</script>