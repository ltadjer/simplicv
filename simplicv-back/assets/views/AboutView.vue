<template>
  <div class="about container mx-auto px-3 py-4 md:px-8 md:py-8">
    <div data-aos="fade-up">
      <h1
        class="text-3xl sm:text-4xl md:text-5xl text-center gap-5 text-blue pt-3 pb-12 sm:pb-20"
      >
        Qui sommes-nous ?
      </h1>
     <div class="flex flex-col gap-12">
      <div
        class="flex flex-col gap-5 sm:flex-row sm:justify-center sm:items-start sm:gap-10"
      >
        <div class="flex flex-col items-end gap-5 text-right sm:w-1/2">
          <img
            src="../../public/images/pages/aide-emploi.png"
            alt="Logo AideEmploi"
            class="m-0 w-1/2 md:w-1/3"
          />
          <h3 class="text-blue font-merriweather font-bold text-lg sm:text-2xl">
            Aide Emploi
          </h3>
          <p class="text-sm sm:text-base">
            Votre avenir, notre engagement : Ensemble vers l'emploi !
          </p>
        </div>
        <div class="text-left sm:w-1/2">
          <p class="text-sm sm:text-base">
            Aide Emploi est une association française qui aide les personnes en
            situation de précarité à trouver un emploi. L'association propose un
            accompagnement personnalisé pour aider les personnes à trouver un
            emploi, à rédiger leur CV et leur lettre de motivation, et à
            préparer les entretiens d'embauche. Elle travaille en partenariat
            avec des entreprises pour faciliter l'insertion professionnelle de
            ses membres. Aide Emploi a été créée en 2008 et a depuis aidé des
            milliers de personnes à retrouver un emploi.
          </p>
        </div>
      </div>
      <div
        class="flex flex-col gap-5 sm:flex-row sm:justify-center sm:items-start sm:gap-10"
      >
        <div class="sm:w-1/2 text-right">
          <p class="text-sm sm:text-base">
            SimpliCV, c'est bien plus qu'un outil en ligne pour créer votre CV.
            Nous sommes là pour vous accompagner dans la réalisation d'un CV qui
            vous correspond vraiment et qui saura mettre en valeur votre
            expérience professionnelle. Notre équipe est à votre disposition
            pour répondre à toutes vos questions et vous aider à chaque étape de
            la création de votre CV. SimpliCV a été créé par Aide Emploi, une
            association qui œuvre pour l'insertion professionnelle des personnes
            en difficulté. En choisissant SimpliCV, vous participez à une action
            solidaire et vous êtes assuré de bénéficier d'un accompagnement de
            qualité.
          </p>
        </div>
        <div class="flex flex-col items-start gap-5 text-left sm:w-1/2">
          <img
            src="../../public/images/pages/logo-simplicv.png"
            alt="Logo SimpliCV"
            class="m-0 w-1/2 md:w-1/3"
          />
          <h3 class="text-blue font-merriweather font-bold text-lg sm:text-2xl">
            SimpliCV
          </h3>
          <p>Créez votre CV en toute simplicité.</p>
        </div>
      </div>
     </div>
    </div>
    <div class="sm:px-8 sm:py-16 py-12" data-aos="fade-up">
      <h2 class="text-2xl sm:text-4xl text-bold text-blue text-center my-4">
        SimpliCV, c'est quoi ?
      </h2>
      <div
        class="grid sm:grid-cols-3 gap-5 items-center justify-items-center text-center py-8"
      >
        <div class="flex flex-col gap-2 w-3/4">
          <img
            src="../../public/images/pages/etape1-choixtemplatecv-simplicv.png"
            alt="Etape 1 - Choisir une template CV"
          />
          <h3 class="text-orange text-xl sm:text-2xl">Simplicité</h3>
          <p class="text-sm sm:text-base">
            Une expérience simple et intuitive pour créer un CV professionnelen
            quelques minutes.
          </p>
        </div>
        <div class="flex flex-col gap-2 w-3/4">
          <img
            src="../../public/images/pages/etape2-remplircv-simplicv.png"
            alt="Etape 2 - Remplir les informations du CV"
          />
          <h3 class="text-orange text-xl sm:text-2xl">Personnalisation</h3>
          <p class="text-sm sm:text-base">
            Personnalisez votre CV en choisissant parmi plusieurs modèles et
            couleurs.
          </p>
        </div>
        <div class="flex flex-col gap-2 w-3/4">
          <img
            src="../../public/images/pages/etape3-telechargercv-simplicv.png"
            alt="Etape 3 - Télécharger le CV"
          />
          <h3 class="text-orange text-xl sm:text-2xl">Accessibilité</h3>
          <p class="text-sm sm:text-base">
            SimpliCV est gratuit, facile à utiliser.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    document.title = "À propos - SympliCV";
  },
};
</script>