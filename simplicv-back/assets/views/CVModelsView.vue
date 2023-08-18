/* Concerver les formations ajoutés avec les cookies / faire meme chose pour les autres blocs */
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
            <input
              type="file"
              name="imageFromForm"
              id="imageFromForm"
              @change="ChangeImage"
            />
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
            <input
              type="text"
              name="drivingLicence"
              id="drivingLicence"
              v-model="drivingLicence"
            />
          </div>
          <button @click.prevent="saveInfosPersoData">Enregistrer</button>
        </div>
        <div class="displayedFormations">
          <div v-for="(formation, index) in formations" :key="index">
            <p>{{ formation.degree }}</p>
            <span>{{ formation.startDate }} - {{ formation.endDate }}</span>
            <button @click.prevent="editFormation(index)">Modifier</button>
            <button @click.prevent="removeFormation(index)">Supprimer</button>
          </div>
        </div>

        <div class="formations">
          <template v-if="isFormVisible || formations.length === 0">
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
              <textarea
                id="descriptionFormation"
                v-model="descriptionFormation"
                placeholder="Description"
              >
Description </textarea
              >
            </div>

            <button
              @click.prevent="
                isEditingFormation ? updateFormation() : saveFormationsData()
              "
            >
              Enregistrer
            </button>
          </template>

          <button v-if="isEditingFormation" @click.prevent="clearFormationForm">
            Supprimer
          </button>
        </div>
        <button @click.prevent="addFormation">
          Ajouter une autre formation
        </button>

        <div class="displayedExperiences">
          <div v-for="(experience, index) in experiences" :key="index">
            <p>{{ experience.jobTitle }}</p>
            <span>{{ experience.startDate }} - {{ experience.endDate }}</span>
            <button @click.prevent="editExperience(index)">Modifier</button>
            <button @click.prevent="removeExperience(index)">Supprimer</button>
          </div>
        </div>

        <div class="experiences">
          <template v-if="isExperienceFormVisible || experiences.length === 0">
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
              <input
                type="text"
                name="cityExperience"
                id="cityExperience"
                v-model="cityExperience"
              />
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
              <textarea
                id="descriptionExperience"
                v-model="descriptionExperience"
                placeholder="Description"
              >
Description </textarea
              >
            </div>
            <div class="field">
              <label for="contractType">Type de contrat </label>
              <input
                type="text"
                name="contractType"
                id="contractType"
                v-model="contractTypeExperience"
              />
            </div>
            <button
              @click.prevent="
                isEditingExperience ? updateExperience() : saveExperiencesData()
              "
            >
              Enregistrer
            </button>
          </template>

          <button
            v-if="isEditingExperience"
            @click.prevent="clearExperienceForm"
          >
            Supprimer
          </button>
        </div>
        <button @click.prevent="addExperience">
          Ajouter une autre expérience
        </button>
        <div class="displayedSkills">
          <div v-for="(skill, index) in skills" :key="index">
            <p>{{ skill.name }}</p>
            <button @click.prevent="editSkill(index)">Modifier</button>
            <button @click.prevent="removeSkill(index)">Supprimer</button>
          </div>
        </div>

        <div class="skills">
          <template v-if="isSkillFormVisible || skills.length === 0">
            <div class="field">
              <label for="name">Compétence </label>
              <input type="text" name="name" id="name" v-model="nameSkill" />
            </div>
            <button
              @click.prevent="isEditingSkill ? updateSkill() : saveSkillsData()"
            >
              Enregistrer
            </button>
          </template>
          <button v-if="isEditingSkill" @click.prevent="clearSkillForm">
            Supprimer
          </button>
        </div>
        <button @click.prevent="addSkill">Ajouter une autre compétence</button>
        <div class="displayedLanguages">
          <div v-for="(language, index) in languages" :key="index">
            <p>{{ language.name }}</p>
            <button @click.prevent="editLanguage(index)">Modifier</button>
            <button @click.prevent="removeLanguage(index)">Supprimer</button>
          </div>
        </div>

        <div class="languages">
          <template v-if="isLanguageFormVisible || languages.length === 0">
            <div class="field">
              <label for="name">Langue </label>
              <input type="text" name="name" id="name" v-model="nameLanguage" />
            </div>
            <button
              @click.prevent="
                isEditingLanguage ? updateLanguage() : saveLanguagesData()
              "
            >
              Enregistrer
            </button>
          </template>
          <button v-if="isEditingLanguage" @click.prevent="clearLanguageForm">
            Supprimer
          </button>
        </div>
        <button @click.prevent="addLanguage">Ajouter une langue</button>
        <div class="diplayedSocialMedias">
          <div v-for="(socialMedia, index) in socialMedias" :key="index">
            <p>{{ socialMedia.name }}</p>
            <button @click.prevent="editSocialMedia(index)">Modifier</button>
            <button @click.prevent="removeSocialMedia(index)">Supprimer</button>
          </div>
        </div>
        <div class="socialMedias">
          <template
            v-if="isSocialMediaFormVisible || socialMedias.length === 0"
          >
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
            <button
              @click.prevent="
                isEditingSocialMedia
                  ? updateSocialMedia()
                  : saveSocialMediasData()
              "
            >
              Enregistrer
            </button>
          </template>
          <button
            v-if="isEditingSocialMedia"
            @click.prevent="clearSocialMediaForm"
          >
            Supprimer
          </button>
        </div>
        <button @click.prevent="addSocialMedia">Ajouter une langue</button>
      </div>

      <div class="preview">
        <TemplateCV
          :name="selectedCVTemplate.name"
          :formations="formations"
          :experiences="experiences"
          :skills="skills"
          :languages="languages"
          :socialMedias="socialMedias"
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
        :formations="formations"
        :experiences="experiences"
        :skills="skills"
        :languages="languages"
        :socialMedias="socialMedias"
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
import jsPDF from "jspdf";
import html2canvas from "html2canvas";

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
      formations: [],
      formationsDataSaved: false,
      editingFormationIndex: -1,
      isEditingFormation: false,
      isFormVisible: false,
      experiences: [],
      isExperienceFormVisible: false,
      isEditingExperience: false,
      editingExperienceIndex: -1,
      skills: [],
      isSkillFormVisible: false,
      isEditingSkill: false,
      editingSkillIndex: -1,
      languages: [],
      isLanguageFormVisible: false,
      isEditingLanguage: false,
      editingLanguageIndex: -1,
      socialMedias: [],
      isSocialMediaFormVisible: false,
      isEditingSocialMedia: false,
      editingSocialMediaIndex: -1,
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
      contractTypeExperience: "",
      nameSkill: "",
      nameLanguage: "",
      nameSocialMedia: "",
      pseudoSocialMedia: "",
      bgColor: "",
      imageFromForm: "",
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
      this.imageFromForm = "";
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
      // Save formations data
      cookies.set("formations", this.formations);
      console.log("Data saved to cookies:", this.formations);

      cookies.set("experiences", this.experiences);
      console.log("Data saved to cookies:", this.experiences);

      cookies.set("skills", this.skills);
      console.log("Data saved to cookies:", this.skills);

      cookies.set("languages", this.languages);
      console.log("Data saved to cookies:", this.languages);

      cookies.set("socialMedias", this.socialMedias);
      console.log("Data saved to cookies:", this.socialMedias);
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

      this.formations = cookies.get("formations") || [];
      console.log("Formations data loaded from cookies:", this.formations);

      this.experiences = cookies.get("experiences") || [];
      console.log("experiences data loaded from cookies:", this.experiences);

      this.skills = cookies.get("skills") || [];
      console.log("skills data loaded from cookies:", this.skills);

      this.languages = cookies.get("languages") || [];
      console.log("languages data loaded from cookies:", this.languages);

      this.socialMedias = cookies.get("socialMedias") || [];
      console.log("socialMedias data loaded from cookies:", this.socialMedias);
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
      const newFormation = {
        degree: this.degree,
        nameSchool: this.nameSchool,
        locationSchool: this.locationSchool,
        startDate: this.startDateFormation,
        endDate: this.endDateFormation,
        description: this.descriptionFormation,
      };

      if (this.isEditingFormation && this.editingFormationIndex >= 0) {
        this.formations[this.editingFormationIndex] = newFormation;
      } else {
        this.formations.push(newFormation);
      }

      this.clearFormationForm();
      this.isFormVisible = false;

      this.saveDataToCookies(); // Save formations data to cookies
    },
    addFormation() {
      this.isFormVisible = true;
      if (this.isEditingFormation && this.editingFormationIndex >= 0) {
        // Update the existing formation
        this.updateFormation();
      } else {
        // Add the new formation
        const newFormation = {
          degree: this.degree,
          nameSchool: this.nameSchool,
          locationSchool: this.locationSchool,
          startDate: this.startDateFormation,
          endDate: this.endDateFormation,
          description: this.descriptionFormation,
        };

        this.cvStore.addFormation([newFormation]);
        this.formationsDataSaved = false; // Reset the saved status
      }

      this.clearFormationForm(); // Clear the form fields
      this.isEditingFormation = false; // Reset the editing mode
    },
    editFormation(index) {
      this.isEditingFormation = true;
      this.editingFormationIndex = index;

      const formation = this.formations[index];
      this.degree = formation.degree;
      this.nameSchool = formation.nameSchool;
      this.locationSchool = formation.locationSchool;
      this.startDateFormation = formation.startDate;
      this.endDateFormation = formation.endDate;
      this.descriptionFormation = formation.description;

      this.isFormVisible = true;
    },
    updateFormation() {
      const updatedFormation = {
        degree: this.degree,
        nameSchool: this.nameSchool,
        locationSchool: this.locationSchool,
        startDate: this.startDateFormation,
        endDate: this.endDateFormation,
        description: this.descriptionFormation,
      };

      this.formations.splice(this.editingFormationIndex, 1, updatedFormation);

      this.clearFormationForm();
      this.isFormVisible = false;
      this.isEditingFormation = false;
    },
    clearFormationForm() {
      // Reset the form fields and editingFormationIndex
      this.degree = "";
      this.nameSchool = "";
      this.locationSchool = "";
      this.startDateFormation = "";
      this.endDateFormation = "";
      this.descriptionFormation = "";
      this.editingFormationIndex = -1;
    },
    removeFormation(index) {
      this.formations.splice(index, 1);
      this.cvStore.removeFormation(index); // Suppression dans le store
      this.saveDataToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveExperiencesData() {
      const newExperience = {
        jobTitle: this.jobTitle,
        employer: this.employer,
        city: this.cityExperience,
        startDate: this.startDateExperience,
        endDate: this.endDateExperience,
        description: this.descriptionExperience,
        contractType: this.contractTypeExperience,
      };

      if (this.isEditingExperience && this.editingExperienceIndex >= 0) {
        // Mettre à jour l'expérience existante
        this.experiences[this.editingExperienceIndex] = newExperience;
      } else {
        // Ajouter la nouvelle expérience
        this.experiences.push(newExperience);
      }

      this.clearExperienceForm();
      this.isExperienceFormVisible = false; // Set this flag to false to hide the form
      this.saveDataToCookies(); // Save data to cookies
    },
    // Méthode pour ajouter une expérience
    addExperience() {
      this.isExperienceFormVisible = true;
      if (this.isEditingExperience && this.editingExperienceIndex >= 0) {
        // Update the existing Experience
        this.updateExperience();
      } else {
        // Add the new Experience
        const newExperience = {
          jobTitle: this.jobTitle,
          employer: this.employer,
          city: this.cityExperience,
          startDate: this.startDateExperience,
          endDate: this.endDateExperience,
          description: this.descriptionExperience,
          contractType: this.contractTypeExperience,
        };

        this.cvStore.addExperience([newExperience]);
        this.experiencesDataSaved = false; // Reset the saved status
      }

      this.clearExperienceForm(); // Clear the form fields
      this.isEditingExperience = false; // Reset the editing mode
    },
    editExperience(index) {
      this.isEditingExperience = true;
      this.editingExperienceIndex = index;

      const experience = this.selectedCV.experiences[index];
      this.jobTitle = experience.jobTitle;
      this.employer = experience.employer;
      this.cityExperience = experience.city;
      this.startDateExperience = experience.startDate;
      this.endDateExperience = experience.endDate;
      this.descriptionExperience = experience.description;
      this.contractTypeExperience = experience.contractType;

      this.isExperienceFormVisible = true;
    },
    updateExperience() {
      const updatedExperience = {
        jobTitle: this.jobTitle,
        employer: this.employer,
        city: this.cityExperience,
        startDate: this.startDateExperience,
        endDate: this.endDateExperience,
        description: this.descriptionExperience,
        contractType: this.contractTypeExperience,
      };

      this.experiences.splice(
        this.editingExperienceIndex,
        1,
        updatedExperience
      );

      this.clearExperienceForm();
      this.isExperienceFormVisible = false;
      this.isEditingExperience = false;
    },

    // Méthode pour réinitialiser le formulaire d'expérience
    clearExperienceForm() {
      this.jobTitle = "";
      this.employer = "";
      this.cityExperience = "";
      this.startDateExperience = "";
      this.endDateExperience = "";
      this.descriptionExperience = "";
      this.contractTypeExperience = "";
      this.editingExperienceIndex = -1;
    },
    removeExperience(index) {
      this.experiences.splice(index, 1);
      this.cvStore.removeExperience(index); // Suppression dans le store
      this.saveDataToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveSkillsData() {
      const newSkill = {
        name: this.nameSkill,
      };

      if (this.isEditingSkill && this.editingSkillIndex >= 0) {
        this.skills[this.editingSkillIndex] = newSkill;
      } else {
        this.skills.push(newSkill);
      }

      this.clearSkillForm();
      this.isSkillFormVisible = false;
      this.saveDataToCookies(); // Save data to cookies
    },

    addSkill() {
      this.isSkillFormVisible = true;
      this.nameSkill = "";
      if (this.isEditingSkill && this.editingSkillIndex >= 0) {
        // Update the existing Skill
        this.updateSkill();
      } else {
        // Add the new Skill
        const newSkill = {
          name: this.nameSkill,
        };

        this.cvStore.addSkill([newSkill]);
        this.skillsDataSaved = false; // Reset the saved status
      }

      this.clearSkillForm(); // Clear the form fields
      this.isEditingSkill = false; // Reset the editing mode
    },
    editSkill(index) {
      this.isEditingSkill = true;
      this.editingSkillIndex = index;

      const skill = this.skills[index];
      this.nameSkill = skill.name;

      this.isSkillFormVisible = true;
    },
    updateSkill() {
      const updatedSkill = {
        name: this.nameSkill,
      };

      this.skills.splice(this.editingSkillIndex, 1, updatedSkill);

      this.clearSkillForm();
      this.isSkillFormVisible = false;
      this.isEditingSkill = false;
    },

    // Méthode pour réinitialiser le formulaire d'expérience
    clearSkillForm() {
      this.name = "";
      this.editingSkillIndex = -1;
    },
    removeSkill(index) {
      this.skills.splice(index, 1);
      this.cvStore.removeSkill(index); // Suppression dans le store
      this.saveDataToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveLanguagesData() {
      const newLanguage = {
        name: this.nameLanguage,
      };

      if (this.isEditingLanguage && this.editingLanguageIndex >= 0) {
        this.languages[this.editingLanguageIndex] = newLanguage;
      } else {
        this.languages.push(newLanguage);
      }

      this.clearLanguageForm();
      this.isLanguageFormVisible = false;
      this.saveDataToCookies(); // Save data to cookies
    },

    addLanguage() {
      this.isLanguageFormVisible = true;
      this.nameLanguage = "";
      if (this.isEditingLanguage && this.editingLanguageIndex >= 0) {
        // Update the existing Language
        this.updateLanguage();
      } else {
        // Add the new Language
        const newLanguage = {
          name: this.nameLanguage,
        };

        this.cvStore.addLanguage([newLanguage]);
        this.languagesDataSaved = false; // Reset the saved status
      }

      this.clearLanguageForm(); // Clear the form fields
      this.isEditingLanguage = false; // Reset the editing mode
    },
    editLanguage(index) {
      this.isEditingLanguage = true;
      this.editingLanguageIndex = index;

      const language = this.languages[index];
      this.nameLanguage = language.name;

      this.isLanguageFormVisible = true;
    },
    updateLanguage() {
      const updatedLanguage = {
        name: this.nameLanguage,
      };

      this.languages.splice(this.editingLanguageIndex, 1, updatedLanguage);

      this.clearLanguageForm();
      this.isLanguageFormVisible = false;
      this.isEditingLanguage = false;
    },

    // Méthode pour réinitialiser le formulaire d'expérience
    clearLanguageForm() {
      this.name = "";
      this.editingLanguageIndex = -1;
    },
    removeLanguage(index) {
      this.languages.splice(index, 1);
      this.cvStore.removeLanguage(index); // Suppression dans le store
      this.saveDataToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveSocialMediasData() {
      const newSocialMedia = {
        name: this.nameSocialMedia,
      };

      if (this.isEditingSocialMedia && this.editingSocialMediaIndex >= 0) {
        this.socialMedias[this.editingSocialMediaIndex] = newSocialMedia;
      } else {
        this.socialMedias.push(newSocialMedia);
      }

      this.clearSocialMediaForm();
      this.isSocialMediaFormVisible = false;
      this.saveDataToCookies(); // Save data to cookies
    },

    addSocialMedia() {
      this.isSocialMediaFormVisible = true;
      this.nameSocialMedia = "";
      this.pseudoSocialMedia = "";
      if (this.isEditingSocialMedia && this.editingSocialMediaIndex >= 0) {
        // Update the existing SocialMedia
        this.updateSocialMedia();
      } else {
        // Add the new SocialMedia
        const newSocialMedia = {
          name: this.nameSocialMedia,
          pseudo: this.pseudoSocialMedia,
        };

        this.cvStore.addSocialMedia([newSocialMedia]);
        this.SocialMediasDataSaved = false; // Reset the saved status
      }

      this.clearSocialMediaForm(); // Clear the form fields
      this.isEditingSocialMedia = false; // Reset the editing mode
    },
    editSocialMedia(index) {
      this.isEditingSocialMedia = true;
      this.editingSocialMediaIndex = index;

      const socialMedia = this.socialMedias[index];
      this.nameSocialMedia = socialMedia.name;

      this.isSocialMediaFormVisible = true;
    },
    updateSocialMedia() {
      const updatedSocialMedia = {
        name: this.nameSocialMedia,
        pseudo: this.pseudoSocialMedia,
      };

      this.socialMedias.splice(
        this.editingSocialMediaIndex,
        1,
        updatedSocialMedia
      );

      this.clearSocialMediaForm();
      this.isSocialMediaFormVisible = false;
      this.isEditingSocialMedia = false;
    },

    // Méthode pour réinitialiser le formulaire d'expérience
    clearSocialMediaForm() {
      this.name = "";
      this.pseudo = "";
      this.editingSocialMediaIndex = -1;
    },
    removeSocialMedia(index) {
      this.socialMedias.splice(index, 1);
      this.cvStore.removeSocialMedia(index); // Suppression dans le store
      this.saveDataToCookies(); // Mettre à jour les cookies si nécessaire
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

      // this.currentStep = "choix-template"; // Retour à la première étape après avoir généré le PDF
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

<style scoped>
button,
[role="button"] {
  background-color: #f55200;
  padding: 10px;
}
</style>
