import { defineStore } from 'pinia';

export const useCVStore = defineStore('cv', {
  state: () => ({
    selectedTemplate: null,
    profil: [],
    formations: [],
    experiences: [],
    skills: [],
    languages: [],
    socialMedias: [],
  }),

  getters: {
    getSelectedTemplate() {
      return this.selectedTemplate;
    },
  },

  actions: {
    setSelectedTemplate(template) {
      this.selectedTemplate = template;
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
  s },
    setLanguages(languages) {
      this.languages = languages;
    },
    addLanguage(language) {
      this.languages.push(language);
    },
    removeLanguage(index) {
      this.languages.splice(index, 1); // Suppression dans le store
  s },
    setSocialMedias(socialMedias) {
      this.socialMedias = socialMedias;
    },
    addSocialMedia(socialMedia) {
      this.socialMedias.push(socialMedia);
    },
    removeSocialMedia(index) {
      this.socialMedias.splice(index, 1); // Suppression dans le store
  s },
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
