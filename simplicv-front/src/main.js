import { createApp } from 'vue';
import router from './router';
import App from './views/App.vue';

createApp({
  delimiters: ['${', '}$'], // Configure Vue.js delimiters
  render: () => {
    return createApp(App).use(router).mount('#app');
  },
}).mount('#app');
