import { defineStore } from "pinia";

export const useCVStore = defineStore("cv", {
  state: () => ({
    selectedTemplate: null,
    profil: [],
    formations: [],
    experiences: [],
    skills: [],
    languages: [],
    socialMedias: [],
    imageFromForm: "",
    capturedImages: {},
    modelCVVisibility: {},
  }),

  getters: {
    getSelectedTemplate() {
      return this.selectedTemplate;
    },
    getCapturedImage: (state) => (cvId) => {
      return state.capturedImages[cvId] || ''; // Récupérez l'image capturée par son ID
    },
  },
  actions: {
    setSelectedTemplate(template) {
      this.selectedTemplate = template;
    },
    setCapturedImage(cvId, capturedImage) {
      this.capturedImages[cvId] = capturedImage; // Stockez l'image capturée dans le store
    },
    setTemplateVisibility(cvId, isVisible) {
      // Mettre à jour la visibilité du modèle de CV dans le store
      const cv = this.modelsCV.find((cv) => cv.id === cvId);
      if (cv) {
        cv.isVisible = isVisible;
      }
    },
    setImageFromForm(image) {
      this.imageFromForm = image;
    },
    setProfil(profil) {
      this.profil = profil;
    },

    setFormations(formations) {
      this.formations = formations;
    },
    addFormation(formation) {
      this.formations.push(formation);
    },
    removeFormation(index) {
      this.formations.splice(index, 1); // Suppression dans le store
    },
    setExperiences(experiences) {
      this.experiences = experiences;
    },
    addExperience(experience) {
      this.experiences.push(experience);
    },
    removeExperience(index) {
      this.experiences.splice(index, 1); // Suppression dans le store
    },
    setSkills(skills) {
      this.skills = skills;
    },
    addSkill(skill) {
      this.skills.push(skill);
    },
    removeSkill(index) {
      this.skills.splice(index, 1); // Suppression dans le store
    },
    setLanguages(languages) {
      this.languages = languages;
    },
    addLanguage(language) {
      this.languages.push(language);
    },
    removeLanguage(index) {
      this.languages.splice(index, 1); // Suppression dans le store
    },
    setSocialMedias(socialMedias) {
      this.socialMedias = socialMedias;
    },
    addSocialMedia(socialMedia) {
      this.socialMedias.push(socialMedia);
    },
    removeSocialMedia(index) {
      this.socialMedias.splice(index, 1); // Suppression dans le store
    },
    reset() {
      this.selectedTemplate = null;
      this.profil = [];
      this.formations = [];
      this.experiences = [];
      this.skills = [];
      this.languages = [];
      this.socialMedias = [];
    },
  },
});
