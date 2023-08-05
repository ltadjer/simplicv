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

    setExperiences(experiences) {
      this.experiences = experiences;
    },
    setSkills(skills) {
      this.skills = skills;
    },
    setLanguages(languages) {
      this.languages = languages;
    },
    setSocialMedias(socialMedias) {
      this.socialMedias = socialMedias;
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
