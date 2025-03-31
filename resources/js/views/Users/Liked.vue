<template>

  <Header title="Favoris" subtitle="Sauvegarder vos recettes préférées.">
  </Header>

  <View title="Mes favoris">
      <RecipesList :filteredRecipes="recipes" v-if="recipes" />
  </View>
</template>
  
<script setup lang="ts">
    import { onMounted, ref } from 'vue';

    import Header from '@/components/Header.vue';
    import View from '@/components/View.vue';

    import RecipesList from '@/components/list/RecipesList.vue';

    // -------------------------------- Fetch recipes --------------------------------
    import useRecipeController from '@/controllers/RecipeController';
    const { fetchFavorites } = useRecipeController();

    const recipes = ref<Array<any>>([])

    onMounted( async () => {
        recipes.value = await fetchFavorites();
    })
</script>