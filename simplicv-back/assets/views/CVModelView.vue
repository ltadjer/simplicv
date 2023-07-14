<template>
  <div>
  <TemplateCV
    :formations="cv.formations"
    :experiences="cv.experiences"
    :languages="cv.languages"
    :skills="cv.skills"
    :socialMedias="cv.socialMedias"
    :name="cv.name"
    :dateOfBirth="cv.profil?.dateOfBirth"
    :phoneNumber="cv.profil?.phoneNumber"
    :postalAddress="cv.profil?.postalAddress"
    :title="cv.profil?.title"
    :description="cv.profil?.description"
    :firstname="cv.profil?.firstname"
    :lastname="cv.profil?.lastname"
    :mailAddress="cv.profil?.mailAddress"
    :drivingLicence="cv.profil?.drivingLicence"
    :city="cv.profil?.city"
    :zipCode="cv.profil?.zipCode"
    :bgColor="cv.bgColor"
    :textColor="cv.textColor"
    :titleFont="cv.titleFont"
    :titleColor="cv.titleColor"
    :textFont="cv.textFont"
    :image="cv.profil?.image"
  ></TemplateCV>
  </div>
</template>

<script>
import axios from 'axios';
import TemplateCV from "../components/TemplateCV.vue";

export default {
  components: {
    TemplateCV,
  },
  data() {
    return {
      cv: {}, // Initialise avec un objet vide
    };
  },
  mounted() {
    this.fetchCV();
  },
  methods: {
    async fetchCV() {
      try {
        const slug = this.$route.params.slug;  // Remplacez par le slug réel du CV
        const response = await axios.get(`/api/modeles-de-cv/${slug}`);
        this.cv = response.data;
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
<style></style>