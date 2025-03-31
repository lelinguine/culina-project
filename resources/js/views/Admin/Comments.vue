<template>

    <Header title="Commentaires" subtitle="Approuver des commentaires.">
    </Header>

    <View title="Commentaires">
      <CommentsList :comments="comments" />
    </View>
  
</template>
  
<script setup lang="ts">
  import Header from '@/components/Header.vue';
  import View from '@/components/View.vue';

  import CommentsList from '@/components/list/CommentsList.vue';

  import { onMounted, ref } from 'vue';

  // --------------------------------- State --------------------------------
  import { useStateStore } from '@/stores/stateStore';
  const stateStore = useStateStore();

  // -------------------------------- Fetch comments --------------------------------
  import useCommentController from '@/controllers/CommentController';
  const { seePendingComments } = useCommentController();

  const comments = ref<Array<any>>([]);

  const addComment = (comment: string) => {
    comments.value.push(comment);
  };

  onMounted( async () => {
      const data = await seePendingComments();
      comments.value = data;
  })
</script>