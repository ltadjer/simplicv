import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import CoverLetterModelsView from '../views/CoverLetterModelsView.vue';
import CoverLetterModelView from '../views/CoverLetterModelView.vue';
import CreateCVView from '../views/CreateCVView.vue';
import CVModelsView from '../views/CVModelsView.vue';
import CVModelView from '../views/CVModelView.vue';
import ContactView from '../views/ContactView.vue';
import LegalNoticeView from '../views/LegalNoticeView.vue';
import PrivacyPolicyView from '../views/PrivacyPolicyView.vue';
import TermsAndConditionsView from '../views/TermsAndConditionsView.vue';

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
        path: '/modeles-de-lettres/:slug',
        name: 'letter-model',
        component: CoverLetterModelView,
      },
      {
        path: '/creer-un-cv',
        name: 'Créer son CV',
        component: CVModelsView,
      },
      {
        path: '/etapes-creation-de-cv',
        name: 'Etapes de création d\'un CV',
        component: CreateCVView,
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
      },
      {
        path: '/mentions-legales',
        name: 'Mentions légales',
        component: LegalNoticeView,
      },
      {
        path: '/politique-de-confidentialite',
        name: 'Politique de confidentialité',
        component: PrivacyPolicyView,
      },
      {
        path: '/conditions-generales-d-utilisation',
        name: 'Conditions générales d\'utilisation',
        component: TermsAndConditionsView,
      }
      
    ],
  });

export default router;
