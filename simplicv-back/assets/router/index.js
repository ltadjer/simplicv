import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import CoverLetterModelsView from '../views/CoverLetterModelsView.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
      {
        path: '/',
        name: 'home',
        component: HomeView,
      },
      {
        path: '/lettres-de-motivation',
        name: 'lettres-de-motivation',
        component: CoverLetterModelsView,
      },
    ],
  });

export default router;
