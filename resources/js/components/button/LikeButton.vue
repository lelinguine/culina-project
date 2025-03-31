<template>
    <Button :variant="buttonVariant" @click="toggleLike">
        <component :is="Heart" /> Favoris
    </Button>
</template>

<script setup lang="ts">
  import { ref, onMounted } from 'vue';

  import { Heart } from "lucide-vue-next";
  import Button from '@/components/ui/button/Button.vue';

  import { defineProps } from 'vue';

  const props = defineProps({
    recipe_id: {
      type: Number,
      required: true
    }
  });

  // -------------------------------- Fetch recipes --------------------------------
  import useRecipeController from '@/controllers/RecipeController';
  const { fetchFavorite, addFavorite, removeFavorite } = useRecipeController();

  const recipes = ref<Array<any>>([])

  onMounted( async () => {
      const result = await fetchFavorite(props.recipe_id);
      if(result) {
        buttonVariant.value = '';
      } 
  })

  const buttonVariant = ref('secondary');

  const toggleLike = async () => {
    if(buttonVariant.value === '') {
        await removeFavorite(props.recipe_id);
        buttonVariant.value = 'secondary';
    } else {
        addFavorite(props.recipe_id);
        buttonVariant.value = '';
    }
  };
</script>