import { defineStore } from 'pinia';

export const useCVStore = defineStore('cv', {
  state: () => ({
    selectedTemplate: null,
    profils: [],
    formations: [],
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

    setProfils(profils) {
      this.profils = profils;
    },

    setFormations(formations) {
      this.formations = formations;
    },

    reset() {
      this.selectedTemplate = null;
      this.profils = [];
      this.formations = [];
    },
  },
});
