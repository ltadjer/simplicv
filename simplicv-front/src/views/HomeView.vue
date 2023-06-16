<template>
  <div class="cover-letters">
    <div class="progress-bar">
      <div :class="{ active: currentStep === 1 }">Choisir une template</div>
      <div :class="{ active: currentStep === 2 }">Remplir ses informations</div>
      <div :class="{ active: currentStep === 3 }">Télécharger</div>
    </div>
    <div v-if="currentStep === 1">
      <h1>Lettres de motivations</h1>
      <section
        v-for="letter in coverLetterModels"
        :key="letter.id"
        :style="{ color: letter.textColor, backgroundColor: letter.bgColor }"
      >
        <div>
          <div>
            <p>{{ letter.coverLetter.firstnameSender }}</p>
            <p>{{ letter.coverLetter.lastnameSender }}</p>
            <p>{{ letter.coverLetter.mailAddressSender }}</p>
            <p>{{ letter.coverLetter.phoneNumberSender }}</p>
          </div>
          <div>
            <p>{{ letter.coverLetter.postalAddressReceiver }}</p>
            <p>{{ letter.coverLetter.zipCodeReceiver }}</p>
            <p>{{ letter.coverLetter.cityReceiver }}</p>
          </div>
        </div>
        <div>
          <div>
            <p>{{ letter.coverLetter.dateOfCreation }}</p>
            <p>{{ letter.coverLetter.placeOfCreation }}</p>
          </div>
          <h3>{{ letter.coverLetter.object }}</h3>
          <p v-html="sanitizeHTML(letter.coverLetter.text)"></p>
        </div>
        <button @click="selectLetterModel(letter)">
          Sélectionner le modèle
        </button>
      </section>
    </div>
    <form v-if="currentStep === 2">
      <input v-model="$store.coverLetter.object" placeholder="Object" />
      <textarea v-model="$store.coverLetter.text" placeholder="Text"></textarea>
      <!-- Ajouter d'autres champs d'information -->
      <button @click.prevent="previewLetter">Aperçu</button>
    </form>

    <!-- Étape 3: Aperçu et Télécharger en PDF -->
    <div v-if="currentStep === 3">
      <div>
        <h2>{{ selectedLetterModel.coverLetter.name }}</h2>
        <!-- Afficher les autres informations du modèle -->
        <h3>Object: {{ $store.coverLetter.object }}</h3>
        <p>{{ $store.coverLetter.text }}</p>
        <!-- Afficher les autres champs d'information -->
      </div>
      <button @click.prevent="downloadPDF">Télécharger en PDF</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import DOMPurify from "dompurify";
import { useCoverLetterStore } from "../stores/coverLetter";

export default {
  data() {
    return {
      coverLetterModels: [],
      selectedLetterModel: null,
      currentStep: 1,
    };
  },
  mounted() {
    this.getCoverLetterModels();
  },
  methods: {
    getCoverLetterModels() {
      axios
        .get("http://127.0.0.1:8000/api/lettres-de-motivation")
        .then((response) => {
          console.log(response.data);
          this.coverLetterModels = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // DOMPurify permet de nettoyer le html passé à v-html avant de l'afficher, réduisant ainsi le risque de vulnérabilités XSS.
    sanitizeHTML(html) {
      return DOMPurify.sanitize(html);
    },
    selectLetterModel(letterModel) {
      this.selectedLetterModel = letterModel;
      // Réinitialiser les champs d'information du store
      useCoverLetterStore().reset(); // Utilisez la fonction useCoverLetterStore pour accéder au store
      // Passer à l'étape suivante (2)
      this.currentStep = 2;
    },

    previewLetter() {
      // Passer à l'étape suivante (3)
      this.currentStep = 3;
    },

    downloadPDF() {
      // Récupérer les données du store coverLetter
      const { object, text } = useCoverLetterStore(); // Utilisez la fonction useCoverLetterStore pour accéder au store

      // ...

      // Réinitialiser le store coverLetter
      useCoverLetterStore().reset(); // Utilisez la fonction useCoverLetterStore pour accéder au store

      // Passer à l'étape suivante (1) pour réinitialiser le processus
      this.currentStep = 1;
    },
  },
};
</script>
