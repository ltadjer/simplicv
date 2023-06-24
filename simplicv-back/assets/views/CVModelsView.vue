<template>
  <div class="cv-models">
    <ol class="progress-bar">
      <li
        :class="{ active: currentStep === 'choix-template' }"
        @click="changeStep('choix-template')"
      >
        Choississez votre template
      </li>
      <li
        :class="{ active: currentStep === 'infos-personnelles' }"
        @click="changeStep('infos-personnelles')"
      >
        Entrez vos informations
      </li>
      <li
        :class="{ active: currentStep === 'telecharger' }"
        @click="changeStep('telecharger')"
      >
        Télécharger votre lettre de motivation
      </li>
    </ol>
    <div v-if="currentStep === 'choix-template'">
      <h1>Modèles de CV</h1>

      <section v-for="cv in modelsCV" :key="cv.id">
        <h2>{{ cv.name }}</h2>
        <TemplateCV
          :formations="cv.formations"
          :profils="cv.profils"
        ></TemplateCV>
        <button @click="selectCV(cv)">Sélectionner le modèle</button>
      </section>
    </div>
    <form v-if="currentStep === 'infos-personnelles'">
      <div class="forms">
        <div class="infos-perso">
          <div class="field">
            <label for="phoneNumber">Téléphone </label>
            <input
              type="tel"
              name="phoneNumber"
              id="phoneNumber"
              v-model="phoneNumber"
            />
          </div>
          <div class="field">
            <label for="postalAddress">Adresse postale </label>
            <input
              type="text"
              name="postalAddress"
              id="postalAddress"
              v-model="postalAddress"
            />
          </div>
          <div class="field">
            <label for="dateOfBirth">Date de création </label>
            <input
              type="date"
              name="dateOfBirth"
              id="dateOfBirth"
              v-model="dateOfBirth"
              required
            />
          </div>
        </div>
      </div>

      <div class="preview">
        <TemplateCV
        :name="selectedCVTemplate.name"
    :formations="selectedCV.formations"
    :profils="profils"
></TemplateCV>
      </div>
      <button @click.prevent="previewLetter">Enregistrer</button>
    </form>
    <div v-if="currentStep === 'telecharger'">
      <TemplateCV
  :name="selectedCVTemplate.name"
  :formations="cvStore.formations"
  :profils="cvStore.profils"
></TemplateCV>
      <button @click.prevent="downloadPDF">Télécharger en PDF</button>
    </div>
  </div>
</template>

<script>

import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV.vue";

export default {
  components: {
    TemplateCV,
  },
  data() {
    return {
      modelsCV: [], // Tableau pour stocker les modèles de CV récupérés
      selectedCV: {
        name: "",
        formations: [],
        profils: [],
      }, // Modèle de CV sélectionné par l'utilisateur
      currentStep: "choix-template", // Étape actuelle du processus
      phoneNumber: "", // Numéro de téléphone
      postalAddress: "", // Adresse postale
      dateOfBirth: "", // Date de naissance
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
    getModelsCV() {
      // Fonction pour récupérer les modèles de CV via une requête Axios
      axios
        .get("http://127.0.0.1:8000/api/modeles-de-cv")
        .then((response) => {
          console.log(response.data);
          this.modelsCV = response.data; // Stockage des modèles de CV dans la variable data
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeStep(step) {
      // Fonction pour changer l'étape actuelle
      this.currentStep = step;
    },
    selectCV(cv) {
      // Fonction pour sélectionner un modèle de CV
      this.selectedCV.name = cv.name;
      this.selectedCV.formations = cv.formations;
      this.selectedCV.profils = [];
      this.cvStore.reset(); // Réinitialisation des données du store CV

      this.cvStore.setSelectedTemplate(cv); // Définition du modèle de CV sélectionné dans le store

      this.currentStep = "infos-personnelles"; // Passage à l'étape suivante
    },

    previewLetter() {
      // Fonction pour prévisualiser la lettre de motivation
      const profils = [
        {
          phoneNumber: this.phoneNumber,
          postalAddress: this.postalAddress,
          dateOfBirth: this.dateOfBirth,
        },

      ];
      this.profils = [
    {
      phoneNumber: this.phoneNumber,
      postalAddress: this.postalAddress,
      dateOfBirth: this.dateOfBirth,
    },
  ];
      if (this.selectedCV && this.selectedCV.name) {
        // Vérification de la sélection d'un modèle de CV
        this.cvStore.setProfils(profils); // Définition des profils dans le store
        console.log(this.phoneNumber);
        console.log(this.selectedCV.name);
        this.cvStore.setFormations(this.selectedCV.formations); // Définition des formations dans le store
      }

      this.currentStep = "telecharger"; // Passage à l'étape suivante
    },

    downloadPDF() {
      // Fonction pour télécharger le CV en format PDF
      const { profils, formations } = this.cvStore;

      // Utilisez les données du store pour générer le PDF

      this.cvStore.reset(); // Réinitialisation des données du store
      this.currentStep = "choix-template"; // Retour à la première étape
    },
  },

  computed: {
    selectedCVTemplate() {
      // Calcul de la propriété "selectedCVTemplate"
      return this.cvStore.getSelectedTemplate; // Récupération du modèle de CV

  },
},

};


</script>

<style>
</style>
