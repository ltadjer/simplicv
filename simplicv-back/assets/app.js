import './styles/app.css';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import router from './router';

import App from './views/App.vue';
import 'tailwindcss/tailwind.css';

const app = createApp(App);

// Configurez les délimiteurs personnalisés
app.config.delimiters = ['${', '}$'];

// Utilisez le routeur et Pinia
app.use(router);
app.use(createPinia());


app.mount('#app');
