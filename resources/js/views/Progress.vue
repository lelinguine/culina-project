
<template>
    <div class="relative flex flex-col items-center justify-center min-h-screen">
      <div class="flex flex-col items-center justify-center">
        <div class="flex items-center space-x-3 m-2">
          <img src="../../assets/cooking-light.png" alt="Culina" class="w-7 h-7 flex dark:hidden"/>
          <img src="../../assets/cooking-dark.png" alt="Culina" class="w-7 h-7 hidden dark:flex"/>
          <h1 class="text-2xl font-semibold leading-none">Culina</h1>
        </div>
        <span class="flex items-center space-x-3 m-2 text-xs text-gray-500">Explorer et partager des recettes uniques créées par la communauté.</span>
      </div>
  
      <div class="flex justify-center absolute bottom-0 left-0 right-0 p-4">
        <div class="w-1/5"><Progress :model-value="progress" /></div>
      </div>
    </div>
</template>

<script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import { Progress } from '@/components/ui/progress';

  const progress = ref(0);
  const router = useRouter();

  import { useColorMode } from '@vueuse/core';
  const mode = useColorMode();

  const startProgress = () => {
    let progressValue = 0;
    let pauseCount = 0;
    const maxProgress = 100;
    const maxPauses = 3;

    const stepProgress = () => {
      if (progressValue < maxProgress) {
        const step = Math.floor(Math.random() * (20 - 5 + 1)) + 5;
        progressValue += step;

        if (progressValue > maxProgress) {
          progressValue = maxProgress;
        }

        progress.value = progressValue;

        if (pauseCount < maxPauses) {
          pauseCount++;
          const randomPauseTime = Math.floor(Math.random() * (800 - 500 + 1)) + 500;
          setTimeout(() => {
            stepProgress();
          }, randomPauseTime); 
        } else {
          progressValue = 100;
          progress.value = progressValue;
          setTimeout(() => {
            router.push('/app');
          }, 200);
        }
      }
    };

    stepProgress();
  };

  onMounted(async () => {
    startProgress();
  });
</script>