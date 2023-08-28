<template>
  <div class="create-cv container mx-auto px-3 py-4 md:px-8 md:py-8">
      <h1 class="text-4xl md:text-5xl text-center gap-5 text-blue pt-3 pb-6">Créez votre CV</h1>
      <div class="grid sm:grid-cols-3 gap-5 items-center justify-items-center text-center py-8">
          <div class="flex flex-col gap-5 w-3/4">
              <img
              :src="require('@/images/etape1-choixtemplatecv-simplicv.png')"
                  alt="Etape 1 - Choisir une template CV"
              />
              <h3 class="text-xl">1. Choisissez un modèle parmi notre sélection.</h3>
          </div>
          <div class="flex flex-col gap-5 w-3/4">
              <img
              :src="require('@/images/etape2-remplircv-simplicv.png')"
                  alt="Etape 2 - Remplir les informations du CV"
              /> 
              <h3 class="text-xl">2. Remplissez votre CV</h3>
          </div>
          <div class="flex flex-col gap-5 w-3/4">
              <img
              :src="require('@/images/etape3-telechargercv-simplicv.png')"
                  alt="Etape 3 - Télécharger le CV"
              />
              <h3 class="text-xl">3. Télécharger votre CV et commencez à postuler</h3>
          </div>
        </div>
      <MyButton class="block mx-auto mb-12"><a href="/creer-un-cv">Commencer maintenant <i class="fa-solid fa-chevron-right pl-4"></i></a></MyButton>
  </div>
</template>
<script>
import MyButton from "../components/MyButton";

export default {
  components: {
      MyButton,
  }
};
</script>
