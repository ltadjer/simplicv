<template>
     <section v-for="cv in modelsCV" :key="cv.id">
        <div class="md:w-1/3">
          <TemplateCV
          
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
        </div>
      </section>
</template>

<script>
import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV";

import html2canvas from "html2canvas";


export default {
  components: {
    TemplateCV,
  },
  data() {
    return {
      modelsCV: [], // Tableau pour stocker les modèles de CV récupérés
    };
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
          this.capturedImages[cv.id] = await this.captureTemplateCV(cv);
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
}
};
</script>