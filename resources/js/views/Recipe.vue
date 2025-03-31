<template>

    <HeadBar>
      <DeleteRecipeButton v-if="stateStore.user?.email === user?.email" />
      <EditRecipeButton v-if="stateStore.user?.email === user?.email" :recipe="recipe" />
      <LikeButton v-if="recipe" :recipe_id="recipe.id" />
    </HeadBar>

    <Header v-if="recipe" :title="recipe.title" :subtitle="recipe.content">
      <div class="flex flex-row items-center justify-center mt-4 mb-20">  
        <TagsList :tags="recipe.tags" />
      </div> 
      <img v-if="recipe"  :src="recipe.media" class="rounded-md object-cover w-full" />
    </Header>
    <Header v-else title="Recettes non trouvée." subtitle="" />

    <HeadBar :isBack="false">
      <AddCommentButton v-if="recipe" :recipe_id="recipe.id" />
    </HeadBar>

    <View v-if="recipe" title="Commentaires">
      <CommentsList :comments="comments" />
    </View>
  
</template>
  
<script setup lang="ts">
  import HeadBar from '@/components/HeadBar.vue';
  import Header from '@/components/Header.vue';
  import View from '@/components/View.vue';

  import AddCommentButton from '@/components/button/AddCommentButton.vue';
  import CommentsList from '@/components/list/CommentsList.vue';
  import TagsList from '@/components/list/TagsList.vue';
  import LikeButton from '@/components/button/LikeButton.vue';
  import DeleteRecipeButton from '@/components/button/DeleteRecipeButton.vue';
  import EditRecipeButton from '@/components/button/EditRecipeButton.vue';

  import { onMounted, ref } from 'vue';

  // --------------------------------- State --------------------------------
  import { useStateStore } from '@/stores/stateStore';
  const stateStore = useStateStore();

  // -------------------------------- Fetch recipe --------------------------------
  import useRecipeController from '@/controllers/RecipeController';
  const { fecthRecipe } = useRecipeController();

  const recipe = ref<any>(null);
  const user = ref<any>(null);
  const comments = ref<Array<any>>([]);

  onMounted( async () => {
      const data = await fecthRecipe();
      recipe.value = data;
      user.value = data.user;
      comments.value = data.comments;
  })
</script>