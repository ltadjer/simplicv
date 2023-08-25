<template>
  <header class="main-header shadow-bottom-lg">
    <nav class="md:container md:mx-auto flex justify-between items-center px-8 py-3">
      <div class="w-28">
        <RouterLink to="/"><img src="../images/logo-simplicv.png" alt="Logo SimpliCV" /></RouterLink>
      </div>

      <div class="md:hidden">
        <button @click="toggleMenu" class="text-orange focus:outline-none">
          <i :class="[menuOpen ? 'fas fa-times' : 'fas fa-bars', 'text-3xl']"></i>
        </button>
      </div>
      
      <ul :class="menuOpen ? 'block' : 'hidden'" class="hidden md:flex space-x-8">
        <li>
          <RouterLink to="/">Accueil</RouterLink>
        </li>
        <li>
          <RouterLink to="/a-propos">À propos</RouterLink>
        </li>
        <li>
          <RouterLink to="/creer-une-lettre-de-motivation">Créer une lettre de motivation</RouterLink>
        </li>
        <li>
          <RouterLink to="/contact">Contact</RouterLink>
        </li>
      </ul>

      <MyButton class="hidden md:block">
        <RouterLink to="/creer-un-cv">Créer un CV</RouterLink>
      </MyButton>
    </nav>

    <ul :class="[menuOpen ? 'block' : 'hidden', 'md:hidden']" class="md:hidden flex flex-col items-center mt-4 space-y-4 px-8 pt-2 pb-3">
      <li><RouterLink to="/">Accueil</RouterLink></li>
      <li><RouterLink to="/a-propos">À propos</RouterLink></li>
      <li><RouterLink to="/creer-une-lettre-de-motivation">Créer une lettre de motivation</RouterLink></li>
      <li><RouterLink to="/contact">Contact</RouterLink></li>
      <li><MyButton><RouterLink to="/creer-un-cv">Créer un CV</RouterLink></MyButton></li>
    </ul>
  </header>
</template>

<script>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';
import MyButton from "../components/MyButton";

export default {
  components: {
    RouterLink,
    MyButton,
  },
  setup() {
    const menuOpen = ref(false);

    const toggleMenu = () => {
      menuOpen.value = !menuOpen.value;
    };

    return {
      menuOpen,
      toggleMenu,
    };
  },
};
</script>
