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
        <TemplateCV
          :formations="cv.formations"
          :experiences="cv.experiences"
          :languages="cv.languages"
          :skills="cv.skills"
          :socialMedias="cv.socialMedias"
          :name="cv.name"
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
        ></TemplateCV>
        <button @click="selectCV(cv)">Sélectionner le modèle</button>
      </section>
    </div>
    <form v-if="currentStep === 'infos-personnelles'">
      <div class="forms">
        <div class="infos-perso">
          <div class="field">
            <label for="title">Titre </label>
            <input
              type="text"
              name="title"
              id="title"
              v-model="title"
              required
            />
          </div>
          <div class="field">
            <textarea v-model="descriptionProfil" placeholder="Description">
Description </textarea
            >
          </div>
          <div class="field">
            <label for="lastname">Nom </label>
            <input
              type="text"
              name="lastname"
              id="lastname"
              v-model="lastname"
              required
            />
          </div>
          <div class="field">
            <label for="firstname">Prénom </label>
            <input
              type="text"
              name="firstname"
              id="firstname"
              v-model="firstname"
              required
            />
          </div>

          <div class="field">
            <label for="mailAddress">Adresse-email </label>
            <input
              type="email"
              name="mailAddress"
              id="mailAddress"
              v-model="mailAddress"
            />
          </div>
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
            <label for="zipCode">Code postal </label>
            <input
              type="number"
              name="zipCode"
              id="zipCode"
              v-model="zipCode"
            />
          </div>
          <div class="field">
            <label for="city">Ville </label>
            <input type="text" name="city" id="city" v-model="city" />
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
        <div class="formations">
          <div class="field">
            <label for="degree">Diplôme </label>
            <input type="text" name="degree" id="degree" v-model="degree" />
          </div>
          <div class="field">
            <label for="nameSchool">Nom de l'établissement </label>
            <input
              type="text"
              name="nameSchool"
              id="nameSchool"
              v-model="nameSchool"
            />
          </div>
          <div class="field">
            <label for="locationSchool">Lieu de l'établissement </label>
            <input
              type="text"
              name="locationSchool"
              id="locationSchool"
              v-model="locationSchool"
            />
          </div>
          <div class="field">
            <label for="startDate">Date de début </label>
            <input
              type="date"
              name="startDate"
              id="startDate"
              v-model="startDateFormation"
            />
          </div>
          <div class="field">
            <label for="endDate">Date de fin </label>
            <input
              type="date"
              name="endDate"
              id="endDate"
              v-model="endDateFormation"
            />
          </div>
          <div class="field">
            <textarea v-model="descriptionFormation" placeholder="Description">
Description </textarea
            >
          </div>
        </div>
        <div class="experiences">
          <div class="field">
            <label for="jobTitle">Intitulé du poste </label>
            <input
              type="text"
              name="jobTitle"
              id="jobTitle"
              v-model="jobTitle"
            />
          </div>
          <div class="field">
            <label for="city">Lieu du poste </label>
            <input type="text" name="city" id="city" v-model="city" />
          </div>
          <div class="field">
            <label for="startDate">Date de début </label>
            <input
              type="date"
              name="startDate"
              id="startDate"
              v-model="startDateExperience"
            />
          </div>
          <div class="field">
            <label for="endDate">Date de fin </label>
            <input
              type="date"
              name="endDate"
              id="endDate"
              v-model="endDateExperience"
            />
          </div>
          <div class="field">
            <textarea v-model="descriptionExperience" placeholder="Description">
Description </textarea
            >
          </div>
        </div>
        <div class="skills">
          <div class="field">
            <label for="name">Compétence </label>
            <input type="text" name="name" id="name" v-model="nameSkill" />
          </div>
        </div>
        <div class="languages">
          <div class="field">
            <label for="name">Language </label>
            <input type="text" name="name" id="name" v-model="nameLanguage" />
          </div>
        </div>
        <div class="socialMedias">
          <div class="field">
            <label for="name">Réseau social </label>
            <input
              type="text"
              name="name"
              id="name"
              v-model="nameSocialMedia"
            />
          </div>
          <div class="field">
            <label for="link">Lien </label>
            <input
              type="text"
              link="link"
              id="link"
              v-model="linkSocialMedia"
            />
          </div>
        </div>
      </div>

      <div class="preview">
        <TemplateCV
          :name="selectedCVTemplate.name"
          :formations="[
            {
              degree: degree,
              nameSchool: nameSchool,
              startDate: startDateFormation,
              endDate: endDateFormation,
              description: descriptionFormation,
            },
          ]"
          :experiences="[
            {
              jobTitle: jobTitle,
              employer: employer,
              city: city,
              startDate: startDateExperience,
              endDate: endDateExperience,
              description: descriptionExperience,
            },
          ]"
          :skills="[
            {
              name: nameSkill,
            },
          ]"
          :languages="[
            {
              name: nameLanguage,
            },
          ]"
          :socialMedias="[
            {
              name: nameSocialMedia,
              link: linkSocialMedia,
            },
          ]"
          :dateOfBirth="dateOfBirth"
          :phoneNumber="phoneNumber"
          :postalAddress="postalAddress"
          :title="title"
          :description="descriptionProfil"
          :firstname="firstname"
          :lastname="lastname"
          :mailAddress="mailAddress"
          :drivingLicence="drivingLicence"
          :city="city"
          :zipCode="zipCode"
        ></TemplateCV>
      </div>
      <button @click.prevent="previewLetter">Enregistrer</button>
    </form>
    <div v-if="currentStep === 'telecharger'">
      <TemplateCV
        :name="selectedCVTemplate.name"
        :formations="[
          {
            degree: degree,
            nameSchool: nameSchool,
            startDate: startDateFormation,
            endDate: endDateFormation,
            description: descriptionFormation,
          },
        ]"
        :experiences="[
          {
            jobTitle: jobTitle,
            employer: employer,
            city: city,
            startDate: startDateExperience,
            endDate: endDateExperience,
            description: descriptionExperience,
          },
        ]"
        :skills="[
          {
            name: nameSkill,
          },
        ]"
        :languages="[
          {
            name: nameLanguage,
          },
        ]"
        :socialMedias="[
          {
            name: nameSocialMedia,
            link: linkSocialMedia,
          },
        ]"
        :dateOfBirth="dateOfBirth"
        :phoneNumber="phoneNumber"
        :postalAddress="postalAddress"
        :title="title"
        :description="descriptionProfil"
        :firstname="firstname"
        :lastname="lastname"
        :mailAddress="mailAddress"
        :drivingLicence="drivingLicence"
        :city="city"
        :zipCode="zipCode"
      ></TemplateCV>
      <button @click.prevent="downloadPDF">Télécharger en PDF</button>
    </div>
  </div>
  <button v-if="currentStep !== 'choix-template'" @click="previousStep">
    Précédent
  </button>
  <button v-if="currentStep === 'choix-template' && selectedCV && selectedCV.name" @click="nextStep">
  Suivant
</button>

</template>

<script>
import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV.vue";
import cookies from "vue-cookies";

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
        experiences: [],
        languages: [],
        skills: [],
        socialMedias: [],
        profil: [],
      }, // Modèle de CV sélectionné par l'utilisateur
      currentStep: "choix-template", // Étape actuelle du processus
      phoneNumber: "",
      postalAddress: "",
      dateOfBirth: "",
      title: "",
      descriptionProfil: "",
      firstname: "",
      lastname: "",
      mailAddress: "",
      drivingLicence: "",
      city: "",
      zipCode: "",
      degree: "",
      nameSchool: "",
      locationSchool: "",
      startDateFormation: "",
      endDateFormation: "",
      descriptionFormation: "",
      jobTitle: "",
      employer: "",
      city: "",
      startDateExperience: "",
      endDateExperience: "",
      descriptionExperience: "",
      nameSkill: "",
      nameLanguage: "",
      nameSocialMedia: "",
      linkSocialMedia: "",
    };
  },
  mounted() {
    this.getModelsCV(); // Appel à la fonction pour récupérer les modèles de CV lors du montage du composant
    this.loadDataFromCookies();
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
      this.selectedCV.formations = [];
      this.selectedCV.experiences = [];
      this.selectedCV.languages = [];
      this.selectedCV.skills = [];
      this.selectedCV.socialMedias = [];
      this.selectedCV.profil = [];
      this.cvStore.reset(); // Réinitialisation des données du store CV

      this.cvStore.setSelectedTemplate(cv); // Définition du modèle de CV sélectionné dans le store

      this.currentStep = "infos-personnelles"; // Passage à l'étape suivante
    },
    saveDataToCookies() {
      cookies.set("phoneNumber", this.phoneNumber);
      cookies.set("postalAddress", this.postalAddress);
      cookies.set("dateOfBirth", this.dateOfBirth);
      cookies.set("title", this.title);
      cookies.set("descriptionProfil", this.descriptionProfil);
      cookies.set("firstname", this.firstname);
      cookies.set("lastname", this.lastname);
      cookies.set("mailAddress", this.mailAddress);
      cookies.set("drivingLicence", this.drivingLicence);
      cookies.set("city", this.city);
      cookies.set("zipCode", this.zipCode);
      cookies.set("degree", this.degree);
      cookies.set("nameSchool", this.nameSchool);
      cookies.set("locationSchool", this.locationSchool);
      cookies.set("startDateFormation", this.startDateFormation);
      cookies.set("endDateFormation", this.endDateFormation);
      cookies.set("descriptionFormation", this.descriptionFormation);
      cookies.set("jobTitle", this.jobTitle);
      cookies.set("employer", this.employer);
      cookies.set("startDateExperience", this.startDateExperience);
      cookies.set("endDateExperience", this.endDateExperience);
      cookies.set("descriptionExperience", this.descriptionExperience);
      cookies.set("nameSkill", this.nameSkill);
      cookies.set("nameLanguage", this.nameLanguage);
      cookies.set("nameSocialMedia", this.nameSocialMedia);
      cookies.set("linkSocialMedia", this.linkSocialMedia);
    },

    loadDataFromCookies() {
      this.phoneNumber = cookies.get("phoneNumber");
      this.postalAddress = cookies.get("postalAddress");
      this.dateOfBirth = cookies.get("dateOfBirth");
      this.title = cookies.get("title");
      this.descriptionProfil = cookies.get("descriptionProfil");
      this.firstname = cookies.get("firstname");
      this.lastname = cookies.get("lastname");
      this.mailAddress = cookies.get("mailAddress");
      this.drivingLicence = cookies.get("drivingLicence");
      this.city = cookies.get("city");
      this.zipCode = cookies.get("zipCode");
      this.degree = cookies.get("degree");
      this.nameSchool = cookies.get("nameSchool");
      this.locationSchool = cookies.get("locationSchool");
      this.startDateFormation = cookies.get("startDateFormation");
      this.endDateFormation = cookies.get("endDateFormation");
      this.descriptionFormation = cookies.get("descriptionFormation");
      this.jobTitle = cookies.get("jobTitle");
      this.employer = cookies.get("employer");
      this.startDateExperience = cookies.get("startDateExperience");
      this.endDateExperience = cookies.get("endDateExperience");
      this.descriptionExperience = cookies.get("descriptionExperience");
      this.nameSkill = cookies.get("nameSkill");
      this.nameLanguage = cookies.get("nameLanguage");
      this.nameSocialMedia = cookies.get("nameSocialMedia");
      this.linkSocialMedia = cookies.get("linkSocialMedia");
    },
    previewLetter() {
      const profil = [
        {
          phoneNumber: this.phoneNumber,
          postalAddress: this.postalAddress,
          dateOfBirth: this.dateOfBirth,
          title: this.title,
          description: this.description,
          firstname: this.firstname,
          lastname: this.lastname,
          mailAddress: this.mailAddress,
          zipCode: this.zipCode,
          city: this.city,
          drivingLicence: this.drivingLicence,
        },
      ];

      const formations = [
        {
          degree: this.degree,
          nameSchool: this.nameSchool,
          locationSchool: this.locationSchool,
          startDate: this.startDateFormation,
          endDate: this.endDateFormation,
          description: this.descriptionFormation,
        },
      ];

      const experiences = [
        {
          jobTitle: this.jobTitle,
          employer: this.employer,
          city: this.city,
          startDate: this.startDateExperience,
          endDate: this.endDateExperience,
          description: this.descriptionExperience,
        },
      ];

      const skills = [
        {
          name: this.nameSkill,
        },
      ];

      const languages = [
        {
          name: this.nameLanguage,
        },
      ];
      const socialMedias = [
        {
          name: this.nameSocialMedia,
          link: this.linkSocialMedia,
        },
      ];

      if (this.selectedCV && this.selectedCV.name) {
        // Vérification de la sélection d'un modèle de CV
        this.cvStore.setProfil(profil); // Définition des profils dans le store
        console.log(this.degree);
        console.log(this.selectedCV.name);
        this.cvStore.setFormations(formations); // Définition des formations dans le store
        this.cvStore.setExperiences(experiences);
        this.cvStore.setLanguages(languages);
        this.cvStore.setSkills(skills);
        this.cvStore.setSocialMedias(socialMedias);
      }
      this.saveDataToCookies();
      this.currentStep = "telecharger"; // Passage à l'étape suivante
    },

    downloadPDF() {
      // Fonction pour télécharger le CV en format PDF
      const {
        profil,
        formations,
        experiences,
        skills,
        languages,
        socialMedias,
      } = this.cvStore;

      // Utilisez les données du store pour générer le PDF

      this.cvStore.reset(); // Réinitialisation des données du store
      this.currentStep = "choix-template"; // Retour à la première étape
    },
    previousStep() {
      // Méthode pour passer à l'étape précédente
      if (this.currentStep === "infos-personnelles") {
        this.currentStep = "choix-template";
      } else if (this.currentStep === "telecharger") {
        this.currentStep = "infos-personnelles";
      }
    },

    nextStep() {
      // Méthode pour passer à l'étape suivante
      if (this.currentStep === "choix-template") {
        this.currentStep = "infos-personnelles";
      } else if (this.currentStep === "infos-personnelles") {
        this.currentStep = "telecharger";
      }
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
