
/* tu dois reprendre à partir du swtich d'affichage pour formation lorsque l'on appuie sur modifier */
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
        Télécharger votre CV
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
        <button @click="selectCV(cv)">Sélectionner le modèle</button>
      </section>
    </div>
    <form v-if="currentStep === 'infos-personnelles'">
      <div class="forms">
        <div class="infos-perso">
          <div>
            <label for="imageFromForm">Photo de profil</label>
            <input type="file" name="imageFromForm" id="imageFromForm"  @change="ChangeImage" />
          </div>
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
            <label for="descriptionProfil">Description </label>
            <textarea id="descriptionProfil" v-model="descriptionProfil">
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
            <label for="dateOfBirth">Date d'anniversaire </label>
            <input
              type="date"
              name="dateOfBirth"
              id="dateOfBirth"
              v-model="dateOfBirth"
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
            <label for="drivingLicence">Type de permis </label>
            <input type="text" name="drivingLicence" id="drivingLicence" v-model="drivingLicence" />
          </div>
          <button @click.prevent="saveInfosPersoData">Enregistrer</button>
        </div>
        <div v-if="formationsDataSaved">
        
          <p>{{ degree }}</p>
          <span>{{ startDateFormation }} - {{ endDateFormation }}</span>
          <button @click.prevent="editFormation(index)">Modifier</button>
          <button @click.prevent="removeFormation(index)">Supprimer</button>
      </div>
        <div class="formations" v-if="!formationsDataSaved">
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
            <label for="descriptionFormation">Description </label>
            <textarea id="descriptionFormation" v-model="descriptionFormation" placeholder="Description">
Description </textarea
            >
          </div>
          <button @click.prevent="saveFormationsData">Enregistrer</button>
          <button @click="addFormation">Ajouter une autre formation</button>
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
            <label for="cityExperience">Lieu du poste </label>
            <input type="text" name="cityExperience" id="cityExperience" v-model="cityExperience" />
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
            <label for="descriptionExperience">Description </label>
            <textarea id="descriptionExperience" v-model="descriptionExperience" placeholder="Description">
Description </textarea
            >
          </div>
          <button @click.prevent="saveExperiencesData">Enregistrer</button>
        </div>
        <div class="skills">
          <div class="field">
            <label for="name">Compétence </label>
            <input type="text" name="name" id="name" v-model="nameSkill" />
          </div>
          <button @click.prevent="saveSkillsData">Enregistrer</button>
        </div>
        <div class="languages">
          <div class="field">
            <label for="name">Language </label>
            <input type="text" name="name" id="name" v-model="nameLanguage" />
          </div>
          <button @click.prevent="saveLanguagesData">Enregistrer</button>
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
            <label for="pseudo">Pseudo </label>
            <input
              type="text"
              link="pseudo"
              id="pseudo"
              v-model="pseudoSocialMedia"
            />
          </div>
          <button @click.prevent="saveSocialMediasData">Enregistrer</button>

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
              pseudo: pseudoSocialMedia,
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
          :imageFromForm="imageFromForm"
          :textColor="selectedCVTemplate.textColor"
          :bgColor="selectedCVTemplate.bgColor"
          :titleColor="selectedCVTemplate.titleColor"
          :textFont="selectedCVTemplate.textFont"
        ></TemplateCV>
      </div>
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
        :imageFromForm="imageFromForm"
        :textColor="selectedCVTemplate.textColor"
        :bgColor="selectedCVTemplate.bgColor"
        :titleColor="selectedCVTemplate.titleColor"
        :textFont="selectedCVTemplate.textFont"
      ></TemplateCV>
      <button @click.prevent="downloadPDF">Télécharger en PDF</button>
    </div>
  </div>
  <button v-if="currentStep !== 'choix-template'" @click="previousStep">
    Précédent
  </button>
  <button v-if="currentStep !== 'telecharger'" @click="nextStep">
  Suivant
</button>

</template>

<script>
import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV.vue";
import cookies from "vue-cookies";
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';


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
      image: "",
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
      cityExperience: "",
      startDateExperience: "",
      endDateExperience: "",
      descriptionExperience: "",
      nameSkill: "",
      nameLanguage: "",
      nameSocialMedia: "",
      pseudoSocialMedia: "",
      bgColor:"", 
      imageFromForm: "",
      formationsDataSaved: false,
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
        .get("/api/modeles-de-cv")
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
      this.imageFromForm = ''; 
      this.cvStore.reset(); // Réinitialisation des données du store CV

      this.cvStore.setSelectedTemplate(cv); // Définition du modèle de CV sélectionné dans le store

      this.currentStep = "infos-personnelles"; // Passage à l'étape suivante
    },
    ChangeImage(event) {
      const file = event.target.files[0];
      this.imageFromForm = URL.createObjectURL(file);
    },

    saveDataToCookies() {
      cookies.set("phoneNumber", this.phoneNumber);
      cookies.set("imageFromForm", this.imageFromForm);
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
      cookies.set("cityExperience");
      cookies.set("startDateExperience", this.startDateExperience);
      cookies.set("endDateExperience", this.endDateExperience);
      cookies.set("descriptionExperience", this.descriptionExperience);
      cookies.set("nameSkill", this.nameSkill);
      cookies.set("nameLanguage", this.nameLanguage);
      cookies.set("nameSocialMedia", this.nameSocialMedia);
      cookies.set("pseudoSocialMedia", this.pseudoSocialMedia);
    },

    loadDataFromCookies() {
      this.imageFromForm = cookies.get("imageFromForm");
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
      this.cityExperience = cookies.get("cityExperience");
      this.startDateExperience = cookies.get("startDateExperience");
      this.endDateExperience = cookies.get("endDateExperience");
      this.descriptionExperience = cookies.get("descriptionExperience");
      this.nameSkill = cookies.get("nameSkill");
      this.nameLanguage = cookies.get("nameLanguage");
      this.nameSocialMedia = cookies.get("nameSocialMedia");
      this.pseudoSocialMedia = cookies.get("pseudoSocialMedia");

      console.log("Formations Data Saved:", this.formationsDataSaved);
    },
    saveInfosPersoData() {
      const profil = [
        {
          imageFromForm: this.imageFromForm,
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
      console.log("profil:", profil);
      if (this.selectedCV && this.selectedCV.name) {
        // Vérification de la sélection d'un modèle de CV
        this.cvStore.setProfil(profil); // Définition des profils dans le store
       
      }
      this.saveDataToCookies();
      
    },
    saveFormationsData() {
      
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

      

      if (this.selectedCV && this.selectedCV.name) {
      // Vérification de la sélection d'un modèle de CV
      this.cvStore.addFormation(formations); // Add the new formation to the store
    }
    this.formationsDataSaved = true; // Mark formations data as saved
    console.log("Formations Data Saved:", this.formationsDataSaved);
    this.saveDataToCookies(); // Save data to cookies (if needed)
    },
    addFormation() {
    const newFormation = {
      degree: "",
      nameSchool: "",
      locationSchool: "",
      startDate: "",
      endDate: "",
      description: "",
    };
    this.cvStore.addFormation(newFormation);
  },
    editFormation(index) {
    // You can use this method to pre-fill the formations form
    // with the data of the selected formation for editing.
    const formation = this.cvStore.formations[index];
    this.degree = formation.degree;
    this.nameSchool = formation.nameSchool;
    this.locationSchool = formation.locationSchool;
    this.startDateFormation = formation.startDate;
    this.endDateFormation = formation.endDate;
    this.descriptionFormation = formation.description;
  },

  removeFormation(index) {
    // This method will remove the selected formation from the formations array.
    this.cvStore.removeFormation(index);
  },

    saveExperiencesData() {
      
      const experiences = [
        {
          jobTitle: this.jobTitle,
          employer: this.employer,
          city: this.cityExperience,
          startDate: this.startDateExperience,
          endDate: this.endDateExperience,
          description: this.descriptionExperience,
        },
      ];

      if (this.selectedCV && this.selectedCV.name) {
        // Vérification de la sélection d'un modèle de CV
        this.cvStore.setExperiences(experiences);
      }
      this.saveDataToCookies();
    },
    saveSkillsData() {
      const skills = [
        {
          name: this.nameSkill,
        },
      ];


      if (this.selectedCV && this.selectedCV.name) {
        this.cvStore.setSkills(skills);
      }
      this.saveDataToCookies();
    },
    saveLanguagesData() {
      const languages = [
        {
          name: this.nameLanguage,
        },
      ];
      if (this.selectedCV && this.selectedCV.name) {
        this.cvStore.setLanguages(languages);
      }
      this.saveDataToCookies();
    },
    saveSocialMediasData() {

      const socialMedias = [
        {
          name: this.nameSocialMedia,
          link: this.pseudoSocialMedia,
        },
      ];

      if (this.selectedCV && this.selectedCV.name) {
        this.cvStore.setSocialMedias(socialMedias);
      }
      this.saveDataToCookies();
      this.currentStep = "telecharger"; // Passage à l'étape suivante
    },

    async downloadPDF() {
      const cvStore = useCVStore(); // Obtenir le store CV

      const {
        profil,
        formations,
        experiences,
        skills,
        languages,
        socialMedias,
      } = cvStore;

     

      this.currentStep = "choix-template"; // Retour à la première étape après avoir généré le PDF
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

<style scoped>
button, [role="button"]  {
background-color: #F55200;
padding: 10px;
}
</style>
