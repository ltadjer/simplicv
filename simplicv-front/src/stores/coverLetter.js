import { defineStore } from 'pinia';

export const useCoverLetterStore = defineStore('coverLetter', {
  state: () => ({
    object: '',
    text: '',
  }),
  actions: {
    setObject(object) {
      this.object = object;
    },
    setText(text) {
      this.text = text;
    },
    reset() {
      this.object = '';
      this.text = '';
    },
  },
});

