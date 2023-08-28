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
import { useCVStore } from "../stores/cv";
export default {
  props: {
    modelsCV: Array,
    currentPage: Number,
    itemsPerPage: Number,
    capturedImages: Object,
    totalPages: Number,
  },
  setup() {
    const cvStore = useCVStore(); // Utilisation du store CV
    const visibleCvs = computed(() => {
      const startIndex = props.currentPage * props.itemsPerPage;
      const endIndex = startIndex + props.itemsPerPage;
      return props.modelsCV.slice(startIndex, endIndex).map((cv) => ({
        ...cv,
        cvCaptured: props.capturedImages[cv.id],
      }));
    });
    return {
      cvStore,
            visibleCvs,

    };
  },
  created() {
    this.adjustItemsPerPage();
    window.addEventListener('resize', this.adjustItemsPerPage);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.adjustItemsPerPage);
  },
  computed: {
    totalPages() {
      return Math.ceil(this.modelsCV.length / this.itemsPerPage);
    },
    visibleCvs() {
      const startIndex = this.currentPage * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.modelsCV.slice(startIndex, endIndex).map((cv) => ({
        ...cv,
        cvCaptured: this.capturedImages[cv.id],
      }));
    },
  },
  methods: {
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
  },
};
</script>