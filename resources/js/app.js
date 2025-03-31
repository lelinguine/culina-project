import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import '../scss/base.scss';
import './bootstrap';

const app = createApp(App);

app.use(router);
app.use(createPinia());
app.mount("#app");