<template>
  <div class="relative">
    <div
      class="sm:grid sm:grid-cols-2 md:grid-cols-3 sm:gap-6 overflow-hidden mx-[5%]"
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
          class="md:w-[90%] border-contour relative flex justify-center items-center mx-auto shadow-lg hover:border hover:border-orange hover:border-2"
        >
          <img
            :src="cvStore.getCapturedImage(cv.id)"
            alt="Template CV"
            style="width: fit-content; height: auto"
            class="opacity-75"
          />
          <MyButton @click="selectCV(cv)" class="absolute top-1/2">
            Sélectionner le modèle
          </MyButton>
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
</template>
  
  <script>
import axios from "axios";

import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV";
import MyButton from "../components/MyButton";

import html2canvas from "html2canvas";

export default {
  props: {
    currentPage: Number,
    totalPages: Number,
  },
  components: {
    TemplateCV,
    MyButton,
  },
  data() {
    return {
      modelsCV: [],
      capturedImages: {},
      imagesCaptured: false, // Initialize as false
    };
  },
  created() {
    this.adjustItemsPerPage();
    window.addEventListener("resize", this.adjustItemsPerPage);
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.adjustItemsPerPage);
  },
  mounted() {
    this.getModelsCV(); // Appel à la fonction pour récupérer les modèles de CV lors du montage du composant
  },
  setup() {
    const cvStore = useCVStore(); // Utilisation du store CV

    return {
      cvStore,
    };
  },
  methods: {
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
  },
};
</script>
