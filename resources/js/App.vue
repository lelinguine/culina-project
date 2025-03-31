<script setup lang="ts">
import { ref, watch } from 'vue';
import { useStateStore } from '@/stores/stateStore';

import GlobalToaster from '@/components/GlobalToaster.vue';

const stateStore = useStateStore();
const toasterRef = ref(null);

watch(() => stateStore.notification, (newValue) => {
    if (newValue) {
        toasterRef.value.showToast(newValue);
        stateStore.setNotification(null);
    }
});
</script>

<template>
    <router-view />
    <GlobalToaster ref="toasterRef"/>
</template>
