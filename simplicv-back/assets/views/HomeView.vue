<template>
  <div class="home">
    <div
      class="hero h-screen sm:h-[80vh] relative container mx-auto sm:mt-[2%]"
      data-aos="fade-up"
    >
      <div
        class="grid gap-12 sm:grid-cols-2 sm:grid-flow-col sm:gap-5 p-8 sm:px-3 sm:py-4 sm:px-8 sm:py-8 sm:items-center sm:justify-center"
      >
        <div
          class="content-hero flex flex-col items-start gap-5 sm:mx-auto sm:w-2/3 sm:w-9/12"
        >
          <h1 class="text-3xl sm:text-5xl text-blue">
            Créez un
            <span class="text-orange text-4xl sm:text-6xl">CV</span>
            professionnel en quelques clics avec Simpli<span
              class="text-orange text-4xl sm:text-6xl"
              >CV</span
            >
          </h1>
          <MyButton
            ><a href="/etapes-creation-de-cv"
              >Créer mon CV maintenant</a
            ></MyButton
          >
        </div>
        <div
          class="img-hero relative justify-self-center align-self-center sm:w-3/5 sm:w-4/5"
        >
          <img
            src="../../public/images/pages/blob-hero.png"
            alt=""
            class="relative z-10"
          />
          <img
            src="../../public/images/pages/illustrationcv.png"
            alt="Créez votre CV en toute simplicité."
            class="absolute top-0 left-0 w-3/4 sm:w-2/3 z-20"
          />
        </div>
      </div>
      <span
        class="btn-down text-6xl text-blue flex justify-center absolute sm:bottom-0 left-1/2"
        ><i @click="scrollToBottom" class="fa-solid fa-chevron-down"></i
      ></span>
    </div>
    <div
      class="values-simplicv sm:px-8 sm:py-16 container mx-auto"
      data-aos="fade-up"
    >
      <h2 class="text-2xl sm:text-4xl text-bold text-blue text-center my-4">
        Pourquoi choisir SimpliCV ?
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
    <div
      class="templates sm:px-8 sm:py-16 container mx-auto"
      data-aos="fade-up"
    >
      <h2 class="text-2xl sm:text-4xl text-bold text-blue text-center my-4">
        Les dernières templates
      </h2>
      <div class="relative py-[5%] mb-20 sm:mb-3">
        <div
          class="sm:grid sm:grid-cols-2 md:grid-cols-3 sm:gap-2 overflow-hidden mx-[2%]"
        >
          <section v-for="cv in visibleCvs" :key="cv.id">
            <TemplateCV
              v-if="!cv.cvCaptured"
              :id="'template-' + cv.id"
              :formations="cv.formations"
              :experiences="cv.experiences"
              :languages="cv.languages"
              :skills="cv.skills"
              :socialMedias="cv.socialMedias"
              :name="cv.name"
              :textColor="cv.textColor"
              :bgColor="cv.bgColor"
              :titleColor="cv.titleColor"
              :textFont="cv.textFont"
              :dateOfBirth="cv.profil.dateOfBirth"
              :phoneNumber="cv.profil.phoneNumber"
              :postalAddress="cv.profil.postalAddress"
              :title="cv.profil.title"
              :description="cv.profil.description"
              :firstname="cv.profil.firstname"
              :lastname="cv.profil.lastname"
              :mailAddress="cv.profil.mailAddress"
              :drivingLicence="cv.profil.drivingLicence"
              :city="cv.profil.city"
              :zipCode="cv.profil.zipCode"
              :image="cv.profil.image"
            ></TemplateCV>
            <div
              class="w-[80%] border-contour relative flex justify-center items-center mx-auto shadow-lg hover:border hover:border-orange hover:border-2"
            >
              <img
                :src="cvStore.getCapturedImage(cv.id)"
                alt="Template CV"
                style="width: fit-content; height: auto"
                class="opacity-75"
              />
            </div>
          </section>
        </div>
        <button
          class="absolute left-0 top-1/2 transform -translate-y-1/2"
          @click="goToPrevious"
          v-if="currentPage > 0"
        >
          <i class="fa-solid fa-chevron-left text-blue text-5xl"></i>
        </button>

        <button
          class="absolute right-0 top-1/2 transform -translate-y-1/2"
          @click="goToNext"
          v-if="currentPage < totalPages - 1"
        >
          <i class="fa-solid fa-chevron-right text-blue text-5xl"></i>
        </button>
      </div>
    </div>
    <div
      class="flex flex-col items-center justify-center gap-5 text-center bg-blue text-background py-10"
    >
      <p class="w-3/4 text-sm sm:text-base">
        SimpliCV, c'est bien plus qu'un outil en ligne pour créer votre CV. Nous
        sommes là pour vous accompagner dans la réalisation d'un CV qui vous
        correspond vraiment et qui saura mettre en valeur votre expérience
        professionnelle. Notre équipe est à votre disposition pour répondre à
        toutes vos questions et vous aider à chaque étape de la création de
        votre CV.
      </p>
      <MyButton
        ><a href="/etapes-creation-de-cv"> Commencer maintenant </a></MyButton
      >
    </div>
    <div class="">#video</div>
  </div>
</template>
  
<script>
import MyButton from "../components/MyButton";
import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV";
import html2canvas from "html2canvas";
import cookies from "vue-cookies";

import AOS from "aos";

AOS.init();

export default {
  components: {
    MyButton,
    TemplateCV,
  },
  data() {
    return {
      modelsCV: [],
      currentPage: 0,
      itemsPerPage: 3,
      capturedImages: {},
      imagesCaptured: false,
    };
  },
  created() {
    this.adjustItemsPerPage();
    window.addEventListener("resize", this.adjustItemsPerPage);
    // Récupérez le nom de la template sélectionnée depuis les cookies
    const selectedTemplate = cookies.get("selectedTemplate");
    if (selectedTemplate) {
      this.selectedTemplateName = selectedTemplate;
    }
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.adjustItemsPerPage);
  },
  mounted() {
    this.getModelsCV(); // Appel à la fonction pour récupérer les modèles de CV lors du montage du composant
    document.title = "Accueil - SimpliCV";
  },
  setup() {
    const cvStore = useCVStore(); // Utilisation du store CV

    return {
      cvStore,
    };
  },
  methods: {
    scrollToBottom() {
      const section = document.querySelector(".values-simplicv");
      section.scrollIntoView({ behavior: "smooth" });
    },
    async getModelsCV() {
      try {
        const response = await axios.get("/api/modeles-de-cv");
        this.modelsCV = response.data;

        for (const cv of this.modelsCV) {
          await this.$nextTick(); // Attendre que les éléments soient rendus
          console.log("Capturing image for CV:", cv);
          const capturedImage = await this.captureTemplateCV(cv);
          this.capturedImages[cv.id] = capturedImage;
          this.cvStore.setCapturedImage(cv.id, capturedImage); // Stockez l'image dans le store Pinia
          console.log("Image captured for CV:", cv);
        }
      } catch (error) {
        console.error("Error fetching models:", error);
      }
    },
    async captureTemplateCV(cv) {
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d");

      console.log("Starting captureTemplateCV for CV:", cv);

      // Dynamically select the template element for each CV
      const templateCvElement = document.querySelector(`#template-${cv.id}`);
      console.log("Template element:", templateCvElement);

      if (!templateCvElement) {
        console.error("Template element not found");
        return;
      }

      const canvasImage = await html2canvas(templateCvElement);

      canvas.width = canvasImage.width;
      canvas.height = canvasImage.height;
      context.drawImage(canvasImage, 0, 0);

      const imageData = canvas.toDataURL("image/png");
      console.log("Image captured:", imageData);

      return imageData;
    },
    async captureImagesForVisibleCvs() {
      for (const cv of this.visibleCvs) {
        if (!this.capturedImages[cv.id]) {
          await this.$nextTick(); // Wait for DOM update
          const capturedImage = await this.captureTemplateCV(cv);
          this.capturedImages[cv.id] = capturedImage;
          this.cvStore.setCapturedImage(cv.id, capturedImage);
        }
      }
    },
    allTemplatesCaptured() {
      return this.modelsCV.every(
        (template) => this.capturedImages[template.id]
      );
    },

    changeStep(step) {
      // Fonction pour changer l'étape actuelle
      this.currentStep = step;
    },
    adjustItemsPerPage() {
      if (window.innerWidth <= 768) {
        this.itemsPerPage = 1;
      } else if (window.innerWidth > 768 && window.innerWidth <= 1024) {
        this.itemsPerPage = 2;
      } else {
        this.itemsPerPage = 3;
      }
    },
    goToPrevious() {
      if (this.currentPage > 0) {
        this.currentPage--;
        this.captureImagesForVisibleCvs(); // Capture images for visible templates
      }
    },
    goToNext() {
      if (this.currentPage < this.totalPages - 1) {
        this.currentPage++;
        console.log("Going to next page");
        this.captureImagesForVisibleCvs(); // Capture images for visible templates
      }
    },
  },
  computed: {
    totalPages() {
      return Math.ceil(this.modelsCV.length / this.itemsPerPage);
    },
    visibleCvs() {
      this.adjustItemsPerPage(); // Appeler la méthode pour ajuster itemsPerPage
      const startIndex = this.currentPage * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      const visibleCvs = this.modelsCV
        .slice(startIndex, endIndex)
        .map((cv) => ({
          ...cv,
          cvCaptured: this.capturedImages[cv.id],
        }));
      return visibleCvs;
    },
  },
};
</script>
 <style>
.btn-down i {
  animation: floating 2s infinite ease-out;
}
@keyframes floating {
  0% {
    transform: translate(0, 0px);
  }
  50% {
    transform: translate(0, 20px);
  }
  100% {
    transform: translate(0, -0px);
  }
}

</style>