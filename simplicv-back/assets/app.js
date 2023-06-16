import './styles/app.css';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import router from './router';
import App from './views/App.vue';

const app = createApp(App);

app.config.delimiters = ['${', '}$']; // Configurez les délimiteurs personnalisés

app.use(router); 
app.use(createPinia())
app.mount('#app');






