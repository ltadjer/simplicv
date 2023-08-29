<template>
  <header class="main-header shadow-bottom-lg">
    <nav class="md:container md:mx-auto flex justify-between items-center px-8 py-3">
      <div class="w-28">
        <RouterLink to="/"><img src="../../public/images/pages/logo-simplicv.png" alt="Logo SimpliCV" /></RouterLink>
      </div>

      <div class="md:hidden">
        <button @click="toggleMenu" class="text-orange focus:outline-none">
          <i :class="[menuOpen ? 'fas fa-times' : 'fas fa-bars', 'text-3xl']"></i>
        </button>
      </div>
      
      <ul :class="menuOpen ? 'block' : 'hidden'" class="hidden md:flex space-x-8">
        <li>
          <RouterLink :class="{'text-orange border-b-2 border-orange font-bold': isActiveLink('/')}" to="/">Accueil</RouterLink>
        </li>
        <li>
          <RouterLink :class="{'text-orange border-b-2 border-orange font-bold': isActiveLink('/a-propos')}" to="/a-propos">À propos</RouterLink>
        </li>
        <li>
          <RouterLink :class="{'text-orange border-b-2 border-orange font-bold': isActiveLink('/creer-une-lettre-de-motivation')}" to="/creer-une-lettre-de-motivation">Créer une lettre de motivation</RouterLink>
        </li>
        <li>
          <RouterLink :class="{'text-orange border-b-2 border-orange font-bold': isActiveLink('/contact')}" to="/contact">Contact</RouterLink>
        </li>
      </ul>

      <MyButton class="hidden md:block">
        <RouterLink to="/etapes-creation-de-cv">Créer un CV</RouterLink>
      </MyButton>
    </nav>

    <ul :class="[menuOpen ? 'block' : 'hidden', 'md:hidden']" class="md:hidden flex flex-col items-center mt-4 space-y-4 px-8 pt-2 pb-3">
      <li><RouterLink @click="closeMenu" to="/"  :class="{'text-orange font-bold': isActiveLink('/')}">Accueil</RouterLink></li>
      <li><RouterLink @click="closeMenu" to="/a-propos" :class="{'text-orange font-bold': isActiveLink('/a-propos')}" >À propos</RouterLink></li>
      <li><RouterLink @click="closeMenu" to="/creer-une-lettre-de-motivation" :class="{'text-orange font-bold': isActiveLink('/creer-une-lettre-de-motivation')}">Créer une lettre de motivation</RouterLink></li>
      <li><RouterLink @click="closeMenu" to="/contact" :class="{'text-orange font-bold': isActiveLink('/contact')}">Contact</RouterLink></li>
      <li><MyButton><RouterLink @click="closeMenu" to="/etapes-creation-de-cv">Créer un CV</RouterLink></MyButton></li>
    </ul>
  </header>
</template>

<script>
import { ref, computed } from 'vue';
import { RouterLink, useRoute } from 'vue-router';

import MyButton from "../components/MyButton";

export default {
  components: {
    RouterLink,
    MyButton,
  },
  setup() {
    const menuOpen = ref(false);
    const route = useRoute();

    const toggleMenu = () => {
      menuOpen.value = !menuOpen.value;
    };

    const isActiveLink = (path) => {
      return route.path === path;
    };

    const closeMenu = () => {
      menuOpen.value = false;
    };
    return {
      menuOpen,
      toggleMenu,
      isActiveLink,
      closeMenu
    };
  },
};
</script>
