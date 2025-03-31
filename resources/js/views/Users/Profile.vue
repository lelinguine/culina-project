<template>
  <HeadBar :isBack="false">
    <EditProfilButton />
  </HeadBar>

  <Header :title="user?.name" :subtitle="user?.email">
    <div class="flex flex-row items-center justify-center mt-4 mb-20">  
      <TagsList v-if="stateStore.user" :tags="stateStore.user?.auth" />
      </div> 
  </Header>

  <View title="">
  </View>
</template>
  
<script setup lang="ts">
  import Header from '@/components/Header.vue';
  import View from '@/components/View.vue';
  import HeadBar from '@/components/HeadBar.vue';
  import TagsList from '@/components/list/TagsList.vue';

  import EditProfilButton from '@/components/button/EditProfilButton.vue';

  import { useStateStore } from '@/stores/stateStore';
  const stateStore = useStateStore();

  import { computed } from 'vue';

  const user = computed(() => stateStore.user);
</script>