<template>
  <div v-if="displayedComments.length" class="flex flex-col gap-4">
    <div v-for="comment in displayedComments" :key="comment.id" class="flex flex-col gap-2">
      <span class="text-gray-500 text-xs">{{ comment.user.name }} - {{ timeAgo(comment.created_at )}}</span>
      <span>{{ comment.content }}</span>
      <span v-if="stateStore.user.auth === 'admin' && comment.status === 'pending'" class="underline text-xs cursor-pointer w-0" @click="onApprove(comment.id)">Approuver</span>
    </div>
  </div>
  <span v-else class="text-gray-500 text-xs">Aucun commentaire pour le moment.</span>
</template>

<script setup lang="ts">
  import { defineProps, ref, watch } from 'vue';
  import useCommentController from '@/controllers/CommentController';

  import { useStateStore } from '@/stores/stateStore';
  const stateStore = useStateStore();

  const props = defineProps({
    comments: {
      type: Array,
      required: true
    }
  });

  // Variable locale pour stocker les commentaires affichés
  const displayedComments = ref([...props.comments]);

  // Mettre à jour displayedComments si comments change (utile si props est réactif)
  watch(() => props.comments, (newComments) => {
    displayedComments.value = [...newComments];
  });

  const { approveComment } = useCommentController();

  const onApprove = async (commentId) => {
    await approveComment(commentId);
    displayedComments.value = displayedComments.value.filter(comment => comment.id !== commentId);
  };

  const timeAgo = (date) => {
    const diff = Math.floor((new Date() - new Date(date)) / 1000);
    const prefix = 'Il y a';
    if (diff < 20) return `${prefix} quelques secondes`;
    if (diff < 60) return `${prefix} ${diff} sec`;
    if (diff < 3600) return `${prefix} ${Math.floor(diff / 60)} min`;
    if (diff < 86400) return `${prefix} ${Math.floor(diff / 3600)} h`;
    if (diff < 2592000) return `${prefix} ${Math.floor(diff / 86400)} j`;
    if (diff < 31536000) return `${prefix} ${Math.floor(diff / 2592000)} mois`;
    return `${prefix} ${Math.floor(diff / 31536000)} ans`;
  };
</script>