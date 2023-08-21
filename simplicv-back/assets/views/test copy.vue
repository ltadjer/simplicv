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
    <div v-if="currentStep === 'infos-personnelles'">
      <div class="forms">
        <MyForm class="infos-perso">
          <MyInput
            label="Photo de profil"
            type="file"
            inputName="imageFromForm"
            @update:value="imageFromForm = $event"
            @changeImage="handleImageChange"
            inputId="imageFromForm"
            :required="true"
          />

          <MyInput
            label="Titre"
            type="text"
            inputName="title"
            :inputValue="title"
            @update:value="title = $event"
            inputId="title"
            :required="true"
          />
          <div v-if="titleError" class="error-message">{{ titleError }}</div>
          <MyInput
            label="Description"
            type="textarea"
            inputName="descriptionProfil"
            :inputValue="descriptionProfil"
            @update:value="descriptionProfil = $event"
            inputId="descriptionProfil"
            :required="true"
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
            inputId="lastname"
            :required="true"
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
            inputId="firstname"
            :required="true"
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
            inputId="dateOfBirth"
            :required="false"
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
            inputId="mailAddress"
            :required="true"
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
            inputId="phoneNumber"
            :required="false"
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
            inputId="postalAddress"
            :required="false"
          />

          <MyInput
            label="Code postal"
            type="number"
            inputName="zipCode"
            :inputValue="zipCode"
            @update:value="zipCode = $event"
            inputId="zipCode"
            :required="false"
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
            inputId="city"
            :required="false"
          />

          <MyInput
            label="Type de permis"
            type="text"
            inputName="drivingLicence"
            :inputValue="drivingLicence"
            @update:value="drivingLicence = $event"
            inputId="drivingLicence"
            :required="false"
          />
          <button @click.prevent="saveInfosPersoData">Enregistrer</button>
        </MyForm>
        <div class="displayedFormations">
          <div v-for="(formation, index) in formations" :key="index">
            <p>{{ formation.degree }}</p>
            <span
              >{{ formatMonthYear(formation.startDate) }} -
              {{ formatMonthYear(formation.endDate) }}</span
            >
            <button @click.prevent="editFormation(index)">Modifier</button>
            <button @click.prevent="removeFormation(index)">Supprimer</button>
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
              inputId="nameSchool"
              :required="true"
            />
            <div v-if="nameSchoolError" class="error-message">
              {{ nameSchoolError }}
            </div>
            <MyInput
              label="Lieu de l'établissement"
              type="text"
              inputName="locationSchool"
              inputId="locationSchool"
              :inputValue="locationSchool"
              @update:value="locationSchool = $event"
              :required="true"
            />
            <div v-if="locationSchoolError" class="error-message">
              {{ locationSchoolError }}
            </div>
            <MyInput
              label="Date de début"
              type="date"
              inputName="startDateFormation"
              inputId="startDateFormation"
              :inputValue="startDateFormation"
              @update:value="startDateFormation = $event"
              :required="true"
            />
            <div v-if="startDateFormationError" class="error-message">
              {{ startDateFormationError }}
            </div>

            <MyInput
              label="Date de fin"
              type="date"
              inputName="endDateFormation"
              inputId="endDateFormation"
              :inputValue="endDateFormation"
              @update:value="endDateFormation = $event"
              :required="true"
            />
            <div v-if="endDateFormationError" class="error-message">
              {{ endDateFormationError }}
            </div>

            <MyInput
              label="Description"
              type="textarea"
              inputName="descriptionFormation"
              inputId="descriptionFormation"
              :inputValue="descriptionFormation"
              @update:value="descriptionFormation = $event"
              :required="false"
            />
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
        </MyForm>
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

        <MyForm class="experiences">
          <template v-if="isExperienceFormVisible || experiences.length === 0">
            <MyInput
              label="Intitulé du poste"
              type="text"
              inputName="jobTitle"
              inputId="jobTitle"
              :inputValue="jobTitle"
              @update:value="jobTitle = $event"
              :required="true"
            />
            <MyInput
              label="Lieu du poste"
              type="text"
              inputName="cityExperience"
              inputId="cityExperience"
              :inputValue="cityExperience"
              @update:value="cityExperience = $event"
              :required="true"
            />
            <MyInput
              label="Date de début"
              type="date"
              inputName="startDateExperience"
              inputId="startDateExperience"
              :inputValue="startDateExperience"
              @update:value="startDateExperience = $event"
              :required="true"
            />
            <MyInput
              label="Date de fin"
              type="date"
              inputName="endDateExperience"
              inputId="endDateExperience"
              :inputValue="endDateExperience"
              @update:value="endDateExperience = $event"
              :required="true"
            />
            <MyInput
              label="Description"
              type="textarea"
              inputName="descriptionExperience"
              inputId="descriptionExperience"
              :inputValue="descriptionExperience"
              @update:value="descriptionExperience = $event"
              :required="true"
            />
            <MyInput
              label="Type de contrat"
              type="text"
              inputName="contractTypeExperience"
              inputId="contractTypeExperience"
              :inputValue="contractTypeExperience"
              @update:value="contractTypeExperience = $event"
              :required="true"
            />
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
        </MyForm>
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

        <MyForm class="skills">
          <template v-if="isSkillFormVisible || skills.length === 0">
            <MyInput
              label="Compétence"
              type="text"
              inputName="nameSkill"
              inputId="nameSkill"
              :inputValue="nameSkill"
              @update:value="nameSkill = $event"
              :required="false"
            />
            <button
              @click.prevent="isEditingSkill ? updateSkill() : saveSkillsData()"
            >
              Enregistrer
            </button>
          </template>
          <button v-if="isEditingSkill" @click.prevent="clearSkillForm">
            Supprimer
          </button>
        </MyForm>
        <button @click.prevent="addSkill">Ajouter une autre compétence</button>
        <div class="displayedLanguages">
          <div v-for="(language, index) in languages" :key="index">
            <p>{{ language.name }}</p>
            <button @click.prevent="editLanguage(index)">Modifier</button>
            <button @click.prevent="removeLanguage(index)">Supprimer</button>
          </div>
        </div>

        <MyForm class="languages">
          <template v-if="isLanguageFormVisible || languages.length === 0">
            <MyInput
              label="Langue"
              type="text"
              inputName="nameLanguage"
              inputId="nameLanguage"
              :inputValue="nameLanguage"
              @update:value="nameLanguage = $event"
              :required="false"
            />
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
        </MyForm>
        <button @click.prevent="addLanguage">Ajouter une langue</button>
        <div class="diplayedSocialMedias">
          <div v-for="(socialMedia, index) in socialMedias" :key="index">
            <p>{{ socialMedia.name }}</p>
            <button @click.prevent="editSocialMedia(index)">Modifier</button>
            <button @click.prevent="removeSocialMedia(index)">Supprimer</button>
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
              inputId="nameSocialMedia"
              :inputValue="nameSocialMedia"
              @update:value="nameSocialMedia = $event"
              :required="false"
            />
            <MyInput
              label="Pseudo"
              type="text"
              inputName="pseudoSocialMedia"
              inputId="pseudoSocialMedia"
              :inputValue="pseudoSocialMedia"
              @update:value="pseudoSocialMedia = $event"
              :required="false"
            />
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
        </MyForm>
        <button @click.prevent="addSocialMedia">
          Ajouter un réseau social
        </button>
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
const encryptionKey = "secretkey"; // Remplacez par votre propre clé

import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV.vue";
import MyForm from "../components/form/MyForm.vue";
import MyInput from "../components/form/MyInput.vue";
import cookies from "vue-cookies";
import cryptoJS from "crypto-js";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
import { parseISO, isBefore, subYears } from "date-fns"; // Importez les fonctions nécessaires

export default {
  components: {
    TemplateCV,
    MyForm,
    MyInput,
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
      phoneNumber: null,
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
      zipCode: null,
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
    handleImageChange(imageUrl) {
      this.imageFromForm = imageUrl; // Mettez à jour l'état Pinia
      this.saveImageToCookies(imageUrl); // Mettez à jour les cookies
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
    isDateValid(startDate, endDate) {
      const startDateObj = new Date(startDate);
      const endDateObj = new Date(endDate);
      return startDateObj >= endDateObj;
    },
    isValidDateFormat(date) {
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      return regex.test(date);
    },
    loadDataFromCookies() {
      const encryptedPersonalData = cookies.get("personalData");
      if (encryptedPersonalData) {
        const decryptedPersonalData = JSON.parse(encryptedPersonalData);

        this.phoneNumber = cryptoJS.AES.decrypt(
          decryptedPersonalData.phoneNumber,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.postalAddress = cryptoJS.AES.decrypt(
          decryptedPersonalData.postalAddress,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.dateOfBirth = cryptoJS.AES.decrypt(
          decryptedPersonalData.dateOfBirth,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.title = cryptoJS.AES.decrypt(
          decryptedPersonalData.title,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.descriptionProfil = cryptoJS.AES.decrypt(
          decryptedPersonalData.descriptionProfil,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.firstname = cryptoJS.AES.decrypt(
          decryptedPersonalData.firstname,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.lastname = cryptoJS.AES.decrypt(
          decryptedPersonalData.lastname,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.mailAddress = cryptoJS.AES.decrypt(
          decryptedPersonalData.mailAddress,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.drivingLicence = cryptoJS.AES.decrypt(
          decryptedPersonalData.drivingLicence,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.city = cryptoJS.AES.decrypt(
          decryptedPersonalData.city,
          encryptionKey
        ).toString(cryptoJS.enc.Utf8);
        this.zipCode = parseInt(
          cryptoJS.AES.decrypt(
            decryptedPersonalData.zipCode,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8)
        );
      }
    },

    // saveDataToCookies() {
    //   //attribut "Secure" pour qu'ils ne soient envoyés que via HTTPS
    //   cookies.set("phoneNumber", this.phoneNumber, { secure: true });
    //   cookies.set("postalAddress", this.postalAddress, { secure: true });
    //   cookies.set("dateOfBirth", this.dateOfBirth, { secure: true });
    //   cookies.set("title", this.title, { secure: true });
    //   cookies.set("descriptionProfil", this.descriptionProfil, { secure: true });
    //   cookies.set("firstname", this.firstname, { secure: true });
    //   cookies.set("lastname", this.lastname, { secure: true });
    //   cookies.set("mailAddress", this.mailAddress, { secure: true });
    //   cookies.set("drivingLicence", this.drivingLicence, { secure: true });
    //   cookies.set("city", this.city, { secure: true });
    //   cookies.set("zipCode", this.zipCode, { secure: true });
    //   cookies.set("degree", this.degree, { secure: true });
    //   cookies.set("nameSchool", this.nameSchool, { secure: true });
    //   cookies.set("locationSchool", this.locationSchool, { secure: true });
    //   cookies.set("startDateFormation", this.startDateFormation, { secure: true });
    //   cookies.set("endDateFormation", this.endDateFormation, { secure: true });
    //   cookies.set("descriptionFormation", this.descriptionFormation, { secure: true });
    //   cookies.set("jobTitle", this.jobTitle, { secure: true });
    //   cookies.set("employer", this.employer, { secure: true });
    //   cookies.set("cityExperience", { secure: true });
    //   cookies.set("startDateExperience", this.startDateExperience, { secure: true });
    //   cookies.set("endDateExperience", this.endDateExperience, { secure: true });
    //   cookies.set("descriptionExperience", this.descriptionExperience, { secure: true });
    //   cookies.set("nameSkill", this.nameSkill, { secure: true });
    //   cookies.set("nameLanguage", this.nameLanguage, { secure: true });
    //   cookies.set("nameSocialMedia", this.nameSocialMedia, { secure: true });
    //   cookies.set("pseudoSocialMedia", this.pseudoSocialMedia, { secure: true });
    //   // Save formations data
    //   cookies.set("formations", this.formations, { secure: true });
    //   console.log("Data saved to cookies:", this.formations, { secure: true });

    //   cookies.set("experiences", this.experiences, { secure: true });
    //   console.log("Data saved to cookies:", this.experiences, { secure: true });

    //   cookies.set("skills", this.skills, { secure: true });
    //   console.log("Data saved to cookies:", this.skills, { secure: true });

    //   cookies.set("languages", this.languages, { secure: true });
    //   console.log("Data saved to cookies:", this.languages, { secure: true });

    //   cookies.set("socialMedias", this.socialMedias, { secure: true });
    //   console.log("Data saved to cookies:", this.socialMedias, { secure: true });
    // },
    saveImageToCookies(image) {
      cookies.set("imageFromForm", image);
    },
    // loadDataFromCookies() {
    //   this.imageFromForm = cookies.get("imageFromForm") || "";
    //   this.phoneNumber = cookies.get("phoneNumber");
    //   this.postalAddress = cookies.get("postalAddress");
    //   this.dateOfBirth = cookies.get("dateOfBirth");
    //   this.title = cookies.get("title");
    //   this.descriptionProfil = cookies.get("descriptionProfil");
    //   this.firstname = cookies.get("firstname");
    //   this.lastname = cookies.get("lastname");
    //   this.mailAddress = cookies.get("mailAddress");
    //   this.drivingLicence = cookies.get("drivingLicence");
    //   this.city = cookies.get("city");
    //   this.zipCode = cookies.get("zipCode");
    //   this.degree = cookies.get("degree");
    //   this.nameSchool = cookies.get("nameSchool");
    //   this.locationSchool = cookies.get("locationSchool");
    //   this.startDateFormation = cookies.get("startDateFormation");
    //   this.endDateFormation = cookies.get("endDateFormation");
    //   this.descriptionFormation = cookies.get("descriptionFormation");
    //   this.jobTitle = cookies.get("jobTitle");
    //   this.employer = cookies.get("employer");
    //   this.cityExperience = cookies.get("cityExperience");
    //   this.startDateExperience = cookies.get("startDateExperience");
    //   this.endDateExperience = cookies.get("endDateExperience");
    //   this.descriptionExperience = cookies.get("descriptionExperience");
    //   this.nameSkill = cookies.get("nameSkill");
    //   this.nameLanguage = cookies.get("nameLanguage");
    //   this.nameSocialMedia = cookies.get("nameSocialMedia");
    //   this.pseudoSocialMedia = cookies.get("pseudoSocialMedia");

    //   this.formations = cookies.get("formations") || [];
    //   console.log("Formations data loaded from cookies:", this.formations);

    //   this.experiences = cookies.get("experiences") || [];
    //   console.log("experiences data loaded from cookies:", this.experiences);

    //   this.skills = cookies.get("skills") || [];
    //   console.log("skills data loaded from cookies:", this.skills);

    //   this.languages = cookies.get("languages") || [];
    //   console.log("languages data loaded from cookies:", this.languages);

    //   this.socialMedias = cookies.get("socialMedias") || [];
    //   console.log("socialMedias data loaded from cookies:", this.socialMedias);
    // },
    saveInfosPersoData() {
      if (!this.validateInfosPersoData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
      const profil = [
        {
          imageFromForm: this.imageFromForm,
          phoneNumber: this.phoneNumber,
          postalAddress: this.postalAddress,
          dateOfBirth: this.dateOfBirth,
          title: this.title,
          description: this.descriptionProfil,
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

      const cookieOptions = { secure: true, expires: 1 }; // 1 day expiration

      // Encrypt and store personal data in cookies
      const encryptedPersonalData = {
        postalAddress: cryptoJS.AES.encrypt(
          this.postalAddress,
          encryptionKey
        ).toString(),
        title: cryptoJS.AES.encrypt(this.title, encryptionKey).toString(),
        descriptionProfil: cryptoJS.AES.encrypt(
          this.descriptionProfil,
          encryptionKey
        ).toString(),
        firstname: cryptoJS.AES.encrypt(
          this.firstname,
          encryptionKey
        ).toString(),
        lastname: cryptoJS.AES.encrypt(this.lastname, encryptionKey).toString(),
        mailAddress: cryptoJS.AES.encrypt(
          this.mailAddress,
          encryptionKey
        ).toString(),
        drivingLicence: cryptoJS.AES.encrypt(
          this.drivingLicence,
          encryptionKey
        ).toString(),
        city: cryptoJS.AES.encrypt(this.city, encryptionKey).toString(),
      };

      cookies.set(
        "personalData",
        JSON.stringify(encryptedPersonalData),
        cookieOptions
      );

      console.log("Personal data saved to cookies:", encryptedPersonalData);
    },
    saveFormationsData() {
      if (!this.validateFormationData()) {
        // Affichez un message d'erreur ou effectuez une autre action en cas de données non valides
        return;
      }
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
      this.pseudoSocialMedia = socialMedia.pseudo;

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

<style scoped>
button,
[role="button"] {
  background-color: #f55200;
  padding: 10px;
}
.error-message {
  color: red;
  font-size: 12px;
  margin-top: 5px;
}
</style>
