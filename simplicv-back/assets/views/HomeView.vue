<template>
  <div class="home">
    <div
      class="hero h-screen sm:h-[80vh] relative container mx-auto sm:mt-[2%]"
    >
      <div class="grid gap-12 sm:grid-cols-2 sm:grid-flow-col sm:gap-5 p-8 sm:px-3 sm:py-4 sm:px-8 sm:py-8 sm:items-center sm:justify-center">
        <div class="content-hero flex flex-col items-start gap-5 sm:mx-auto sm:w-2/3 sm:w-4/5">
        <h1 class="text-3xl sm:text-5xl text-blue">
          Créez un <span class="text-orange">CV</span> professionnel en quelques
          clics avec Simpli<span class="text-orange">CV</span>
        </h1>
        <MyButton><a href="/etapes-creation-de-cv">Créer mon CV maintenant</a></MyButton>
      </div>
      <div class="img-hero relative justify-self-center	align-self-center sm:w-3/5 sm:w-4/5">
        <img :src="require('@/images/blob-hero.png')" alt="" class="relative z-10">
        <img
        :src="require('@/images/illustrationcv.png')"
          alt="Créez votre CV en toute simplicité."
          class="absolute top-0 left-0 w-3/4 sm:w-2/3 z-20"
        />
      </div>
      </div>
      <span class="text-6xl text-blue flex justify-center absolute sm:bottom-0 left-1/2"><i class="fa-solid fa-chevron-down"></i></span>
    </div>
    <div class="sm:px-8 sm:py-16 container mx-auto">
      <h2 class="text-2xl sm:text-4xl text-bold text-blue text-center my-4">
        Pourquoi choisir SimpliCV ?
      </h2>
      <div class="grid sm:grid-cols-3 gap-5 items-center justify-items-center text-center py-8">
        <div class="flex flex-col gap-2 w-3/4">
          <img
          :src="require('@/images/etape1-choixtemplatecv-simplicv.png')"
            alt="Etape 1 - Choisir une template CV"
          />
          <h3 class="text-orange text-xl sm:text-2xl">Simplicité</h3>
          <p class="text-sm	sm:text-base">
            Une expérience simple et intuitive pour créer un CV professionnelen
            quelques minutes.
          </p>
        </div>
        <div class="flex flex-col gap-2 w-3/4">
          <img
          :src="require('@/images/etape2-remplircv-simplicv.png')"
            alt="Etape 2 - Remplir les informations du CV"
          />
          <h3 class="text-orange text-xl sm:text-2xl">Personnalisation</h3>
          <p class="text-sm	sm:text-base">
            Personnalisez votre CV en choisissant parmi plusieurs modèles et
            couleurs.
          </p>
        </div>
        <div class="flex flex-col gap-2 w-3/4">
          <img
          :src="require('@/images/etape3-telechargercv-simplicv.png')"
            alt="Etape 3 - Télécharger le CV"
          />
          <h3 class="text-orange text-xl sm:text-2xl">Accessibilité</h3>
          <p class="text-sm	sm:text-base">SimpliCV est gratuit, facile à utiliser.</p>
        </div>
      </div>
    </div>
    <div class="templates">
      <h2 class="text-2xl sm:text-4xl text-bold text-blue text-center my-4">Les templates les plus populaires</h2>
    </div>
    <div class="flex flex-col items-center justify-center gap-5 text-center bg-blue text-background py-10">
      <p class="w-3/4 text-sm	sm:text-base">
        SimpliCV, c'est bien plus qu'un outil en ligne pour créer votre CV. Nous
        sommes là pour vous accompagner dans la réalisation d'un CV qui vous
        correspond vraiment et qui saura mettre en valeur votre expérience
        professionnelle. Notre équipe est à votre disposition pour répondre à
        toutes vos questions et vous aider à chaque étape de la création de
        votre CV.
      </p><MyButton><a href="/etapes-creation-de-cv">
      Commencer maintenant </a></MyButton>
    </div>
    <div class="">#video</div>
  </div>
</template>
  
  <script>
import MyButton from "../components/MyButton";
export default {
  components: {
    MyButton,
  },
};
</script>
 