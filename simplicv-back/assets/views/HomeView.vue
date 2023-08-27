<template>
  <div class="home">
    <div
      class="hero h-[80vh] relative container mx-auto md:mt-[2%]"
    >
      <div class=" grid gap-12 md:grid-cols-2 md:grid-flow-col md:gap-5 px-3 py-4 md:px-8 md:py-8 md:items-center md:justify-center">
        <div class="content-hero flex flex-col items-start gap-5 sm:mx-auto sm:w-2/3 md:w-4/5">
        <h1 class="text-5xl text-blue">
          Créez un <span class="text-orange">CV</span> professionnel en quelques
          clics avec Simpli<span class="text-orange">CV</span>
        </h1>
        <MyButton>Créer mon CV maintenant</MyButton>
      </div>
      <div class="img-hero relative justify-self-center	align-self-center sm:w-3/5 md:w-4/5">
        <img src="../images/blob-hero.png" alt="" class="relative z-10">
        <img
          src="../images/illustrationcv.png"
          alt="Créez votre CV en toute simplicité."
          class="absolute top-0 left-0 w-3/4 sm:w-2/3 z-20"
        />
      </div>
      </div>
      <span class="text-6xl text-blue flex justify-center absolute bottom-0 left-1/2"><i class="fa-solid fa-chevron-down"></i></span>
    </div>
    <div class="sm:px-8 sm:py-16 container mx-auto">
      <h2 class="text-4xl text-bold text-blue text-center my-4">
        Pourquoi choisir SimpliCV ?
      </h2>
      <div class="grid sm:grid-cols-3 gap-5 items-center justify-items-center text-center py-8">
        <div class="flex flex-col gap-2 w-3/4">
          <img
            src="../images/etape1-choixtemplatecv-simplicv.png"
            alt="Etape 1 - Choisir une template CV"
          />
          <h3 class="text-orange text-2xl">Simplicité</h3>
          <p>
            Une expérience simple et intuitive pour créer un CV professionnelen
            quelques minutes.
          </p>
        </div>
        <div class="flex flex-col gap-2 w-3/4">
          <img
            src="../images/etape2-remplircv-simplicv.png"
            alt="Etape 2 - Remplir les informations du CV"
          />
          <h3 class="text-orange text-2xl">Personnalisation</h3>
          <p>
            Personnalisez votre CV en choisissant parmi plusieurs modèles et
            couleurs.
          </p>
        </div>
        <div class="flex flex-col gap-2 w-3/4">
          <img
            src="../images/etape3-telechargercv-simplicv.png"
            alt="Etape 3 - Télécharger le CV"
          />
          <h3 class="text-orange text-2xl">Accessibilité</h3>
          <p>SimpliCV est gratuit, facile à utiliser.</p>
        </div>
      </div>
    </div>
    <div class="templates">
      <h2 class="text-4xl text-bold text-blue text-center my-4">Les templates les plus populaires</h2>
    </div>
    <div class="flex flex-col items-center justify-center gap-5 text-center bg-blue text-background py-10">
      <p class="w-3/4">
        SimpliCV, c'est bien plus qu'un outil en ligne pour créer votre CV. Nous
        sommes là pour vous accompagner dans la réalisation d'un CV qui vous
        correspond vraiment et qui saura mettre en valeur votre expérience
        professionnelle. Notre équipe est à votre disposition pour répondre à
        toutes vos questions et vous aider à chaque étape de la création de
        votre CV.
      </p>
      <MyButton>Commencer maintenant</MyButton>
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
 