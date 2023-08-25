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
        <MyButton @click="selectCV(cv)">Sélectionner le modèle</MyButton>
      </section>
    </div>
    <div v-if="currentStep === 'infos-personnelles'">
      <div class="forms">
        <MyForm class="infos-perso">
          <MyInput
            label="Photo de profil"
            type="file"
            inputName="imageFromForm"
            :inputValue="imageFromForm"
            @update:value="imageFromForm = $event"
            @changeImage="handleImageChange"
          />
          <MyInput
            label="Titre"
            type="text"
            inputName="title"
            :inputValue="title"
            @update:value="title = $event"
            :required="required"
            inputId="title"
          />
          <div v-if="titleError" class="error-message">{{ titleError }}</div>
          <MyInput
            label="Description"
            type="textarea"
            inputName="descriptionProfil"
            :inputValue="descriptionProfil"
            @update:value="descriptionProfil = $event"
          />
          <div v-if="descriptionProfilError" class="error-message">
            {{ descriptionProfilError }}
          </div>
          <MyInput
            label="Nom"
            type="text"
            inputName="lastname"
            :inputValue="lastname"
            @update:value="lastname = $event"
          />
          <div v-if="lastnameError" class="error-message">
            {{ lastnameError }}
          </div>
          <MyInput
            label="Prénom"
            type="text"
            inputName="firstname"
            :inputValue="firstname"
            @update:value="firstname = $event"
          />
          <div v-if="firstnameError" class="error-message">
            {{ firstnameError }}
          </div>
          <MyInput
            label="Date d'anniversaire"
            type="date"
            inputName="dateOfBirth"
            :inputValue="dateOfBirth"
            @update:value="dateOfBirth = $event"
          />
          <div v-if="dateOfBirthError" class="error-message">
            {{ dateOfBirthError }}
          </div>
          <MyInput
            label="Adresse-email"
            type="email"
            inputName="mailAddress"
            :inputValue="mailAddress"
            @update:value="mailAddress = $event"
          />
          <div v-if="mailAddressError" class="error-message">
            {{ mailAddressError }}
          </div>
          <MyInput
            label="Téléphone"
            type="tel"
            inputName="phoneNumber"
            :inputValue="phoneNumber"
            @update:value="phoneNumber = $event"
          />
          <div v-if="phoneNumberError" class="error-message">
            {{ phoneNumberError }}
          </div>
          <MyInput
            label="Adresse postale"
            type="text"
            inputName="postalAddress"
            :inputValue="postalAddress"
            @update:value="postalAddress = $event"
          />

          <MyInput
            label="Code postal"
            type="number"
            inputName="zipCode"
            :inputValue="zipCode"
            @update:value="zipCode = $event"
          />
          <div v-if="zipCodeError" class="error-message">
            {{ zipCodeError }}
          </div>
          <MyInput
            label="Ville"
            type="text"
            inputName="city"
            :inputValue="city"
            @update:value="city = $event"
          />

          <MyInput
            label="Type de permis"
            type="text"
            inputName="drivingLicence"
            :inputValue="drivingLicence"
            @update:value="drivingLicence = $event"
          />
          <MyButton @click.prevent="saveInfosPersoData">Enregistrer</MyButton>
        </MyForm>
        <div class="displayedFormations">
          <div v-for="(formation, index) in formations" :key="index">
            <p>{{ formation.degree }}</p>
            <span>{{ formation.startDate }} - {{ formation.endDate }}</span>
            <MyButton @click.prevent="editFormation(index)">Modifier</MyButton>
            <MyButton @click.prevent="removeFormation(index)">Supprimer</MyButton>
          </div>
        </div>
        <MyForm class="formations">
          <template v-if="isFormVisible || formations.length === 0">
            <MyInput
              label="Diplôme"
              type="text"
              inputName="degree"
              :inputValue="degree"
              @update:value="degree = $event"
            />
            <MyInput
              label="Nom de l'établissement"
              type="text"
              inputName="nameSchool"
              :inputValue="nameSchool"
              @update:value="nameSchool = $event"
            />
            <div v-if="nameSchoolError" class="error-message">
              {{ nameSchoolError }}
            </div>
            <MyInput
              label="Lieu de l'établissement"
              type="text"
              inputName="locationSchool"
              :inputValue="locationSchool"
              @update:value="locationSchool = $event"
            />
            <div v-if="locationSchoolError" class="error-message">
              {{ locationSchoolError }}
            </div>
            <MyInput
              label="Date de début"
              type="date"
              inputName="startDateFormation"
              :inputValue="startDateFormation"
              @update:value="startDateFormation = $event"
            />
            <div v-if="startDateFormationError" class="error-message">
              {{ startDateFormationError }}
            </div>
            <MyInput
              label="Date de fin"
              type="date"
              inputName="endDateFormation"
              :inputValue="endDateFormation"
              @update:value="endDateFormation = $event"
            />
            <div v-if="endDateFormationError" class="error-message">
              {{ endDateFormationError }}
            </div>
            <MyInput
              label="Description"
              type="textarea"
              inputName="descriptionFormation"
              :inputValue="descriptionFormation"
              @update:value="descriptionFormation = $event"
            />
            <MyButton
              @click.prevent="
                isEditingFormation ? updateFormation() : saveFormationsData()
              "
            >
              Enregistrer
            </MyButton>
          </template>

          <MyButton v-if="isEditingFormation" @click.prevent="clearFormationForm">
            Supprimer
          </MyButton>
        </MyForm>
        <MyButton @click.prevent="addFormation">
          Ajouter une autre formation
        </MyButton>

        <div class="displayedExperiences">
          <div v-for="(experience, index) in experiences" :key="index">
            <p>{{ experience.jobTitle }}</p>
            <span>{{ experience.startDate }} - {{ experience.endDate }}</span>
            <MyButton @click.prevent="editExperience(index)">Modifier</MyButton>
            <MyButton @click.prevent="removeExperience(index)">Supprimer</MyButton>
          </div>
        </div>

        <MyForm class="experiences">
          <template v-if="isExperienceFormVisible || experiences.length === 0">
            <MyInput
              label="Intitulé du poste"
              type="text"
              inputName="jobTitle"
              :inputValue="jobTitle"
              @update:value="jobTitle = $event"
            />
            <div v-if="jobTitleError" class="error-message">
              {{ jobTitleError }}
            </div>
            <MyInput
              label="Lieu du poste"
              type="text"
              inputName="cityExperience"
              :inputValue="cityExperience"
              @update:value="cityExperience = $event"
            />
            <div v-if="cityExperienceError" class="error-message">
              {{ cityExperienceError }}
            </div>
            <MyInput
              label="Date de début"
              type="date"
              inputName="startDateExperience"
              :inputValue="startDateExperience"
              @update:value="startDateExperience = $event"
            />
            <div v-if="startDateExperienceError" class="error-message">
              {{ startDateExperienceError }}
            </div>

            <MyInput
              label="Date de fin"
              type="date"
              inputName="endDateExperience"
              :inputValue="endDateExperience"
              @update:value="endDateExperience = $event"
            />
            <div v-if="endDateExperienceError" class="error-message">
              {{ endDateExperienceError }}
            </div>

            <MyInput
              label="Description"
              type="textarea"
              inputName="descriptionExperience"
              :inputValue="descriptionExperience"
              @update:value="descriptionExperience = $event"
            />
            <MyInput
              label="Type de contrat"
              type="text"
              inputName="contractTypeExperience"
              :inputValue="contractTypeExperience"
              @update:value="contractTypeExperience = $event"
            />
            <MyButton
              @click.prevent="
                isEditingExperience ? updateExperience() : saveExperiencesData()
              "
            >
              Enregistrer
            </MyButton>
          </template>

          <MyButton
            v-if="isEditingExperience"
            @click.prevent="clearExperienceForm"
          >
            Supprimer
          </MyButton>
        </MyForm>
        <MyButton @click.prevent="addExperience">
          Ajouter une autre expérience
        </MyButton>
        <div class="displayedSkills">
          <div v-for="(skill, index) in skills" :key="index">
            <p>{{ skill.name }}</p>
            <MyButton @click.prevent="editSkill(index)">Modifier</MyButton>
            <MyButton @click.prevent="removeSkill(index)">Supprimer</MyButton>
          </div>
        </div>

        <MyForm class="skills">
          <template v-if="isSkillFormVisible || skills.length === 0">
            <MyInput
              label="Compétence"
              type="text"
              inputName="nameSkill"
              :inputValue="nameSkill"
              @update:value="nameSkill = $event"
            />
            <MyButton
              @click.prevent="isEditingSkill ? updateSkill() : saveSkillsData()"
            >
              Enregistrer
            </MyButton>
          </template>
          <MyButton v-if="isEditingSkill" @click.prevent="clearSkillForm">
            Supprimer
          </MyButton>
        </MyForm>
        <MyButton @click.prevent="addSkill">Ajouter une autre compétence</MyButton>
        <div class="displayedLanguages">
          <div v-for="(language, index) in languages" :key="index">
            <p>{{ language.name }}</p>
            <MyButton @click.prevent="editLanguage(index)">Modifier</MyButton>
            <MyButton @click.prevent="removeLanguage(index)">Supprimer</MyButton>
          </div>
        </div>

        <MyForm class="languages">
          <template v-if="isLanguageFormVisible || languages.length === 0">
            <MyInput
              label="Langue"
              type="text"
              inputName="nameLanguage"
              :inputValue="nameLanguage"
              @update:value="nameLanguage = $event"
            />
            <MyButton
              @click.prevent="
                isEditingLanguage ? updateLanguage() : saveLanguagesData()
              "
            >
              Enregistrer
            </MyButton>
          </template>
          <MyButton v-if="isEditingLanguage" @click.prevent="clearLanguageForm">
            Supprimer
          </MyButton>
        </MyForm>
        <MyButton @click.prevent="addLanguage">Ajouter une langue</MyButton>
        <div class="diplayedSocialMedias">
          <div v-for="(socialMedia, index) in socialMedias" :key="index">
            <p>{{ socialMedia.name }}</p>
            <MyButton @click.prevent="editSocialMedia(index)">Modifier</MyButton>
            <MyButton @click.prevent="removeSocialMedia(index)">Supprimer</MyButton>
          </div>
        </div>
        <MyForm class="socialMedias">
          <template
            v-if="isSocialMediaFormVisible || socialMedias.length === 0"
          >
            <MyInput
              label="Réseau social"
              type="text"
              inputName="nameSocialMedia"
              :inputValue="nameSocialMedia"
              @update:value="nameSocialMedia = $event"
            />
            <MyInput
              label="Pseudo"
              type="text"
              inputName="pseudoSocialMedia"
              :inputValue="pseudoSocialMedia"
              @update:value="pseudoSocialMedia = $event"
            />
            <MyButton
              @click.prevent="
                isEditingSocialMedia
                  ? updateSocialMedia()
                  : saveSocialMediasData()
              "
            >
              Enregistrer
            </MyButton>
          </template>
          <MyButton
            v-if="isEditingSocialMedia"
            @click.prevent="clearSocialMediaForm"
          >
            Supprimer
          </MyButton>
        </MyForm>
        <MyButton @click.prevent="addSocialMedia">Ajouter une langue</MyButton>
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
    </div>
    <div v-if="currentStep === 'telecharger'">
      <TemplateCV
        ref="cvComponent"
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
      <MyButton @click.prevent="downloadPDF">Télécharger en PDF</MyButton>
    </div>
  </div>
  <MyButton v-if="currentStep !== 'choix-template'" @click="previousStep">
    Précédent
  </MyButton>
  <MyButton v-if="currentStep !== 'telecharger'" @click="nextStep">
    Suivant
  </MyButton>
</template>

<script>
import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV";
import MyForm from "../components/form/MyForm.vue";
import MyInput from "../components/form/MyInput.vue";
import MyButton from "../components/MyButton";
import cookies from "vue-cookies";
import DOMPurify from "dompurify";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
import { parseISO, isBefore, subYears } from "date-fns"; // Importez les fonctions nécessaires

import cryptoJS from "crypto-js";
const encryptionKey = "secretkey";

export default {
  components: {
    TemplateCV,
    MyForm,
    MyInput,
    MyButton,
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
      firstnameError: "",
      lastnameError: "",
      mailAddressError: "",
      phoneNumberError: "",
      postalAddressError: "",
      zipCodeError: "",
      titleError: "",
      descriptionProfilError: "",
      dateOfBirthError: "",
      degreeError: "",
      locationSchoolError: "",
      nameSchoolError: "",
      startDateFormationError: "",
      endDateFormationError: "",
      jobTitleError: "",
      cityExperienceError: "",
      startDateExperienceError: "",
      endDateExperienceError: "",
    };
  },

  mounted() {
    this.getModelsCV(); // Appel à la fonction pour récupérer les modèles de CV lors du montage du composant
    this.loadFormationsFromCookies();
    this.loadExperiencesFromCookies();
    this.loadSkillsFromCookies();
    this.loadLanguagesFromCookies();
    this.loadSocialMediasFromCookies();
    this.loadInfosPersoFromCookies();
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
    handleImageChange(imageUrl) {
      this.imageFromForm = imageUrl; // Mettez à jour l'état Pinia
      this.saveImageToCookies(imageUrl); // Mettez à jour les cookies
    },

    saveImageToCookies(image) {
      cookies.set("imageFromForm", image);
    },
    sanitizeAndEscape(text) {
      // Utilisez DOMPurify pour nettoyer les données
      const sanitizedText = DOMPurify.sanitize(text);
      // Échappez les caractères spéciaux HTML pour éviter les attaques XSS
      const escapedText = this.escapeHtml(sanitizedText);
      return escapedText;
    },
    escapeHtml(text) {
      // Fonction d'échappement des caractères spéciaux HTML
      return text.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    },
    validateInfosPersoData() {
      this.titleError = this.title ? "" : "Le titre est requis.";
      this.descriptionProfilError = this.descriptionProfil
        ? ""
        : "La description est requise.";
      this.firstnameError = this.firstname ? "" : "Le prénom est requis.";
      this.lastnameError = this.lastname ? "" : "Le nom est requis.";
      this.mailAddressError = this.validateEmail(this.mailAddress)
        ? ""
        : "Adresse e-mail invalide.";
      this.phoneNumberError = this.validatePhoneNumber(this.phoneNumber)
        ? ""
        : "Numéro de téléphone invalide.";
      this.postalAddressError = this.postalAddress
        ? ""
        : "L'adresse postale est requise.";
      this.zipCodeError = this.validateZipCode(this.zipCode)
        ? ""
        : "Code postal invalide.";
      this.dateOfBirthError = this.validateDateOfBirth(this.dateOfBirth)
        ? ""
        : "Vous devez avoir plus de 16 ans.";

      // Retourne vrai si toutes les validations sont passées, sinon retourne faux
      return (
        !this.titleError &&
        !this.descriptionProfilError &&
        !this.firstnameError &&
        !this.lastnameError &&
        !this.mailAddressError &&
        !this.phoneNumberError &&
        !this.postalAddressError &&
        !this.dateOfBirthError &&
        !this.zipCodeError
      );
    },
    validateDateOfBirth(dateOfBirth) {
      // Validez si la personne a plus de 16 ans
      const birthDate = parseISO(dateOfBirth);
      const minAgeDate = subYears(new Date(), 16); // La date d'il y a 16 ans
      return isBefore(birthDate, minAgeDate); // Si la date d'anniversaire est avant la date d'il y a 16 ans
    },
    // Méthode pour valider l'email
    validateEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    },
    // Méthode pour valider le numéro de téléphone
    validatePhoneNumber(phoneNumber) {
      // Implémentez votre propre logique de validation pour le numéro de téléphone
      return /^[0-9]{10}$/.test(phoneNumber);
    },
    // Méthode pour valider le code postal
    validateZipCode(zipCode) {
      // Implémentez votre propre logique de validation pour le code postal
      return /^[0-9]{5}$/.test(zipCode);
    },

    formatMonthYear(date) {
      const options = { month: "2-digit", year: "numeric" };
      return new Intl.DateTimeFormat("fr-FR", options).format(new Date(date));
    },
    validateFormationData() {
      this.degreeError = this.degree ? "" : "Le champ 'Diplôme' est requis.";
      this.nameSchoolError = this.nameSchool
        ? ""
        : "Le champ 'Nom de l'établissement' est requis.";
      this.locationSchoolError = this.locationSchool
        ? ""
        : "Le champ 'Lieu de l'établissement' est requis.";

      // Validation de la date de début
      this.startDateFormationError = !this.startDateFormation
        ? "Le champ 'Date de début' est requis."
        : !this.isValidDateFormat(this.startDateFormation)
        ? "Le format de la date est invalide."
        : "";

      // Validation de la date de fin
      this.endDateFormationError = !this.endDateFormation
        ? "Le champ 'Date de fin' est requis."
        : !this.isValidDateFormat(this.endDateFormation)
        ? "Le format de la date est invalide."
        : this.isDateValid(this.startDateFormation, this.endDateFormation)
        ? "La date de fin doit être supérieure à la date de début."
        : "";

      // Vérifiez toutes les erreurs et retournez vrai si toutes les validations sont passées, sinon retournez faux
      return (
        !this.degreeError &&
        !this.nameSchoolError &&
        !this.locationSchoolError &&
        !this.startDateFormationError &&
        !this.endDateFormationError
      );
    },
    validateExperienceData() {
      this.jobTitleError = this.jobTitle
        ? ""
        : "Le champ 'Intitulé du poste' est requis.";
      this.cityExperienceError = this.cityExperience
        ? ""
        : "Le champ 'Lieu du poste' est requis.";

      // Validation de la date de début
      this.startDateExperienceError = !this.startDateExperience
        ? "Le champ 'Date de début' est requis."
        : !this.isValidDateFormat(this.startDateExperience)
        ? "Le format de la date est invalide."
        : "";

      // Validation de la date de fin
      this.endDateExperienceError = !this.endDateExperience
        ? "Le champ 'Date de fin' est requis."
        : !this.isValidDateFormat(this.endDateExperience)
        ? "Le format de la date est invalide."
        : this.isDateValid(this.startDateExperience, this.endDateExperience)
        ? "La date de fin doit être supérieure à la date de début."
        : "";

      // Vérifiez toutes les erreurs et retournez vrai si toutes les validations sont passées, sinon retournez faux
      return (
        !this.jobTitleError &&
        !this.cityExperienceError &&
        !this.startDateExperienceError &&
        !this.endDateExperienceError
      );
    },
    isDateValid(startDate, endDate) {
      const startDateObj = new Date(startDate);
      const endDateObj = new Date(endDate);
      return startDateObj >= endDateObj;
    },
    isValidDateFormat(date) {
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      return regex.test(date);
    },
    saveInfosPersoData() {
      if (!this.validateInfosPersoData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
      const profil = {
        imageFromForm: this.sanitizeAndEscape(this.imageFromForm),
        phoneNumber: this.sanitizeAndEscape(this.phoneNumber),
        postalAddress: this.sanitizeAndEscape(this.postalAddress),
        title: this.sanitizeAndEscape(this.title),
        descriptionProfil: this.sanitizeAndEscape(this.descriptionProfil),
        firstname: this.sanitizeAndEscape(this.firstname),
        lastname: this.sanitizeAndEscape(this.lastname),
        mailAddress: this.sanitizeAndEscape(this.mailAddress),
        drivingLicence: this.sanitizeAndEscape(this.drivingLicence),
        city: this.sanitizeAndEscape(this.city),
        zipCode: this.sanitizeAndEscape(this.zipCode),
        dateOfBirth: this.sanitizeAndEscape(this.dateOfBirth),
      };

      console.log("profil:", profil);
      if (this.selectedCV && this.selectedCV.name) {
        // Vérification de la sélection d'un modèle de CV
        this.cvStore.setProfil(profil); // Définition des profils dans le store
      }

      const encryptedProfil = cryptoJS.AES.encrypt(
        JSON.stringify(profil),
        encryptionKey
      ).toString();

      cookies.set("personalData", encryptedProfil, "1d", null, null, true, "Strict");
      console.log("Personal data saved to cookies:", encryptedProfil);
    },
    loadInfosPersoFromCookies() {
      try {
        const encryptedProfil = cookies.get("personalData");

        if (encryptedProfil) {
          const decryptedProfilBytes = cryptoJS.AES.decrypt(
            encryptedProfil,
            encryptionKey
          );

          if (decryptedProfilBytes.sigBytes === 0) {
            console.error("Error decrypting data.");
            return;
          }

          const decryptedProfil = JSON.parse(
            decryptedProfilBytes.toString(cryptoJS.enc.Utf8)
          );

          this.imageFromForm = decryptedProfil.imageFromForm;
          this.phoneNumber = decryptedProfil.phoneNumber;
          this.postalAddress = decryptedProfil.postalAddress;
          this.title = decryptedProfil.title;
          this.descriptionProfil = decryptedProfil.descriptionProfil;
          this.firstname = decryptedProfil.firstname;
          this.lastname = decryptedProfil.lastname;
          this.mailAddress = decryptedProfil.mailAddress;
          this.drivingLicence = decryptedProfil.drivingLicence;
          this.city = decryptedProfil.city;
          this.zipCode = decryptedProfil.zipCode;
          this.dateOfBirth = decryptedProfil.dateOfBirth;

          console.log("Personal data loaded from cookies:", decryptedProfil);
        }
      } catch (error) {
        console.error("Error while decrypting/parsing data:", error);
      }
    },
    saveFormationsData() {
      if (!this.validateFormationData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }

      const newFormation = {
        degree: this.sanitizeAndEscape(this.degree),
        nameSchool: this.sanitizeAndEscape(this.nameSchool),
        locationSchool: this.sanitizeAndEscape(this.locationSchool),
        startDate: this.startDateFormation,
        endDate: this.endDateFormation,
        description: this.sanitizeAndEscape(this.descriptionFormation),
      };

      if (this.isEditingFormation && this.editingFormationIndex >= 0) {
        this.formations[this.editingFormationIndex] = newFormation;
      } else {
        this.formations.push(newFormation);
      }
      this.clearFormationForm();
      this.isFormVisible = false;
      this.saveFormationsToCookies();
    },
    saveFormationsToCookies() {
      // crypter les stocker les data dans cookies
      const encryptedFormations = cryptoJS.AES.encrypt(
        JSON.stringify(this.formations),
        encryptionKey
      ).toString();


      cookies.set("formationsData", encryptedFormations, "1d", null, null, true, "Strict");
      console.log("Formations data loaded from cookies:", encryptedFormations);
    },
    loadFormationsFromCookies() {
      try {
        const encryptedFormations = cookies.get("formationsData");
        if (encryptedFormations) {
          const decryptedFormations = cryptoJS.AES.decrypt(
            encryptedFormations,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.formations = JSON.parse(decryptedFormations);
          console.log(
            "Formations data loaded from cookies:",
            decryptedFormations
          );
        }
      } catch (error) {
        console.error("Error while decrypting/parsing formations data:", error);
      }
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
      if (!this.validateFormationData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
      const updatedFormation = {
        degree: this.sanitizeAndEscape(this.degree),
        nameSchool: this.sanitizeAndEscape(this.nameSchool),
        locationSchool: this.sanitizeAndEscape(this.locationSchool),
        startDate: this.sanitizeAndEscape(this.startDateFormation),
        endDate: this.sanitizeAndEscape(this.endDateFormation),
        description: this.sanitizeAndEscape(this.descriptionFormation),
      };

      this.formations.splice(this.editingFormationIndex, 1, updatedFormation);

      this.clearFormationForm();
      this.isFormVisible = false;
      this.isEditingFormation = false;
      this.saveFormationsToCookies();
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
      this.saveFormationsToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveExperiencesData() {
      // Code pour la sauvegarde des expériences (similaire à la sauvegarde des formations)
      const newExperience = {
        jobTitle: this.sanitizeAndEscape(this.jobTitle),
        employer: this.sanitizeAndEscape(this.employer),
        city: this.sanitizeAndEscape(this.cityExperience),
        startDate: this.sanitizeAndEscape(this.startDateExperience),
        endDate: this.sanitizeAndEscape(this.endDateExperience),
        description: this.sanitizeAndEscape(this.descriptionExperience),
        contractType: this.sanitizeAndEscape(this.contractTypeExperience),
      };

      if (this.isEditingExperience && this.editingExperienceIndex >= 0) {
        // Mettre à jour l'expérience existante
        this.experiences[this.editingExperienceIndex] = newExperience;
      } else {
        // Ajouter la nouvelle expérience
        this.experiences.push(newExperience);
      }

      this.clearExperienceForm();
      this.isExperienceFormVisible = false; // cacher le formulaire
      this.saveExperiencesToCookies(); // Appel de la fonction pour sauvegarder les expériences dans les cookies
    },
    saveExperiencesToCookies() {
      // Encrypt and store experiences data in cookies
      const encryptedExperiences = cryptoJS.AES.encrypt(
        JSON.stringify(this.experiences),
        encryptionKey
      ).toString();
      // 1 day expiration

      cookies.set("experiencesData", encryptedExperiences, "1d", null, null, true, "Strict");
      console.log("Experiences data saved to cookies:", encryptedExperiences);
    },
    loadExperiencesFromCookies() {
      try {
        const encryptedExperiences = cookies.get("experiencesData");
        if (encryptedExperiences) {
          const decryptedExperiences = cryptoJS.AES.decrypt(
            encryptedExperiences,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.experiences = JSON.parse(decryptedExperiences);
          console.log(
            "Experiences data loaded from cookies:",
            decryptedExperiences
          );
        }
      } catch (error) {
        console.error(
          "Error while decrypting/parsing experiences data:",
          error
        );
      }
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

      const experience = this.experiences[index];
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
      if (!this.validateExperienceData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
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
      this.saveExperiencesToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveSkillsData() {
      const newSkill = {
        name:  this.sanitizeAndEscape(this.nameSkill),
      };

      if (this.isEditingSkill && this.editingSkillIndex >= 0) {
        this.skills[this.editingSkillIndex] = newSkill;
      } else {
        this.skills.push(newSkill);
      }
      
      this.clearSkillForm();
      this.isSkillFormVisible = false;
      this.saveSkillsToCookies();
    },
    saveSkillsToCookies() {
      // Encrypt and store Skills data in cookies
      const encryptedSkills = cryptoJS.AES.encrypt(
        JSON.stringify(this.skills),
        encryptionKey
      ).toString();
      // 1 day expiration

      cookies.set("skillsData", encryptedSkills, "1d", null, null, true, "Strict");
      console.log("Skills data saved to cookies:", encryptedSkills);
    },
    loadSkillsFromCookies() {
      try {
        const encryptedSkills = cookies.get("skillsData");
        if (encryptedSkills) {
          const decryptedSkills = cryptoJS.AES.decrypt(
            encryptedSkills,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.skills = JSON.parse(decryptedSkills);
          console.log(
            "Skills data loaded from cookies:",
            decryptedSkills
          );
        }
      } catch (error) {
        console.error(
          "Error while decrypting/parsing skills data:",
          error
        );
      }
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
          name:  this.sanitizeAndEscape(this.nameSkill),
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
      this.saveSkillsToCookies(); // Mettre à jour les cookies
    },
    clearSkillForm() {
      this.name = "";
      this.editingSkillIndex = -1;
    },
    removeSkill(index) {
      this.skills.splice(index, 1);
      this.cvStore.removeSkill(index); // Suppression dans le store
      this.saveSkillsToCookies(); // Mettre à jour les cookies
    },
    saveLanguagesData() {
      const newLanguage = {
        name:  this.sanitizeAndEscape(this.nameLanguage),
      };

      if (this.isEditingLanguage && this.editingLanguageIndex >= 0) {
        this.languages[this.editingLanguageIndex] = newLanguage;
      } else {
        this.languages.push(newLanguage);
      }

      this.clearLanguageForm();
      this.isLanguageFormVisible = false;
      this.saveLanguagesToCookies()// Save data to cookies
    },
    saveLanguagesToCookies() {
      // Encrypt and store Languages data in cookies
      const encryptedLanguages = cryptoJS.AES.encrypt(
        JSON.stringify(this.languages),
        encryptionKey
      ).toString();
      // 1 day expiration

      cookies.set("languagesData", encryptedLanguages, "1d", null, null, true, "Strict");
      console.log("Languages data saved to cookies:", encryptedLanguages);
    },
    loadLanguagesFromCookies() {
      try {
        const encryptedLanguages = cookies.get("languagesData");
        if (encryptedLanguages) {
          const decryptedLanguages = cryptoJS.AES.decrypt(
            encryptedLanguages,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.languages = JSON.parse(decryptedLanguages);
          console.log(
            "Languages data loaded from cookies:",
            decryptedLanguages
          );
        }
      } catch (error) {
        console.error(
          "Error while decrypting/parsing Languages data:",
          error
        );
      }
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
          name:  this.sanitizeAndEscape(this.nameLanguage),
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
        name:  this.sanitizeAndEscape(this.nameLanguage),
      };

      this.languages.splice(this.editingLanguageIndex, 1, updatedLanguage);

      this.clearLanguageForm();
      this.isLanguageFormVisible = false;
      this.isEditingLanguage = false;
      this.saveLanguagesToCookies();
    },
    clearLanguageForm() {
      this.name = "";
      this.editingLanguageIndex = -1;
    },
    removeLanguage(index) {
      this.languages.splice(index, 1);
      this.cvStore.removeLanguage(index); // Suppression dans le store
      this.saveLanguagesToCookies()// Mettre à jour les cookies si nécessaire
    },
    saveSocialMediasData() {
      const newSocialMedia = {
        name:  this.sanitizeAndEscape(this.nameSocialMedia),
      };

      if (this.isEditingSocialMedia && this.editingSocialMediaIndex >= 0) {
        this.socialMedias[this.editingSocialMediaIndex] = newSocialMedia;
      } else {
        this.socialMedias.push(newSocialMedia);
      }

      this.clearSocialMediaForm();
      this.isSocialMediaFormVisible = false;
      this.saveSocialMediasToCookies()
      // Save data to cookies
    },
    saveSocialMediasToCookies() {
      // crypter et stocker dans les cookies
      const encryptedSocialMedias = cryptoJS.AES.encrypt(
        JSON.stringify(this.socialMedias),
        encryptionKey
      ).toString();

      cookies.set("socialMediasData", encryptedSocialMedias, "1d", null, null, true, "Strict");
      console.log("SocialMedias data saved to cookies:", encryptedSocialMedias);
    },
    loadSocialMediasFromCookies() {
      try {
        const encryptedSocialMedias = cookies.get("socialMediasData");
        if (encryptedSocialMedias) {
          const decryptedSocialMedias = cryptoJS.AES.decrypt(
            encryptedSocialMedias,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.socialMedias = JSON.parse(decryptedSocialMedias);
          console.log(
            "SocialMedias data loaded from cookies:",
            decryptedSocialMedias
          );
        }
      } catch (error) {
        console.error(
          "Error while decrypting/parsing SocialMedias data:",
          error
        );
      }
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
          name:  this.sanitizeAndEscape(this.nameSocialMedia),
          pseudo:  this.sanitizeAndEscape(this.pseudoSocialMedia),
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
      this.pseudoSocialMedia = socialMedia.pseudo;

      this.isSocialMediaFormVisible = true;
    },
    updateSocialMedia() {
      const updatedSocialMedia = {
        name: this.sanitizeAndEscape(this.nameSocialMedia),
        pseudo: this.sanitizeAndEscape(this.pseudoSocialMedia),
      };

      this.socialMedias.splice(
        this.editingSocialMediaIndex,
        1,
        updatedSocialMedia
      );

      this.clearSocialMediaForm();
      this.isSocialMediaFormVisible = false;
      this.isEditingSocialMedia = false;
      this.saveSocialMediasToCookies()
    },
    clearSocialMediaForm() {
      this.name = "";
      this.pseudo = "";
      this.editingSocialMediaIndex = -1;
    },
    removeSocialMedia(index) {
      this.socialMedias.splice(index, 1);
      this.cvStore.removeSocialMedia(index); // Suppression dans le store
      this.saveSocialMediasToCookies() // Mettre à jour les cookies si nécessaire
    },
    async downloadPDF() {
      // Récupérer la référence au composant CV
      const cvComponent = this.$refs.cvComponent;

      // Générer le contenu HTML du CV
      const cvContent = cvComponent.$el.outerHTML;

      // Convertir le contenu HTML en PDF
      const pdf = new jsPDF();
      const canvas = await html2canvas(cvComponent.$el);
      const imgData = canvas.toDataURL("image/png");
      pdf.addImage(imgData, "PNG", 10, 10, 190, 280);
      pdf.save("mon_cv.pdf");
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

