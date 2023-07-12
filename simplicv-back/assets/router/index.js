import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import CoverLetterModelsView from '../views/CoverLetterModelsView.vue';
import CVModelsView from '../views/CVModelsView.vue';
import CVModelView from '../views/CVModelView.vue';
import ContactView from '../views/ContactView.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
      {
        path: '/',
        name: 'home',
        component: HomeView,
      },
      {
        path: '/a-propos',
        name: 'About',
        component: AboutView,
      },
      {
        path: '/creer-une-lettre-de-motivation',
        name: 'Créer votre lettre de motivation',
        component: CoverLetterModelsView,
      },
      {
        path: '/creer-un-cv',
        name: 'Créer son CV',
        component: CVModelsView,
      },
      {
        path: '/modeles-de-cv/:slug',
        name: 'cv-model',
        component: CVModelView,
      },
      {
        path: '/contact',
        name: 'Contact',
        component: ContactView,
      }
      
    ],
  });

export default router;
