<template>
  <div class="cover-letters">
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
      <h1>Lettres de motivations</h1>
      <section
        v-for="letter in coverLetterModels"
        :key="letter.id"
        :style="{ color: letter.textColor, backgroundColor: letter.bgColor }"
      >
        <TemplateCoverLetter
          :object="letter.coverLetter.object"
          :text="letter.coverLetter.text"
          :firstnameSender="letter.coverLetter.firstnameSender"
          :lastnameSender="letter.coverLetter.lastnameSender"
          :mailAddressSender="letter.coverLetter.mailAddressSender"
          :phoneNumberSender="letter.coverLetter.phoneNumberSender"
          :postalAddressSender="letter.coverLetter.postalAddressSender"
          :zipCodeSender="letter.coverLetter.zipCodeSender"
          :citySender="letter.coverLetter.citySender"
          :firstnameReceiver="letter.coverLetter.firstnameReceiver"
          :lastnameReceiver="letter.coverLetter.lastnameReceiver"
          :nameCompany="letter.coverLetter.nameCompany"
          :postalAddressReceiver="letter.coverLetter.postalAddressReceiver"
          :zipCodeReceiver="letter.coverLetter.zipCodeReceiver"
          :cityReceiver="letter.coverLetter.cityReceiver"
          :dateOfCreation="letter.coverLetter.dateOfCreation"
          :placeOfCreation="letter.coverLetter.placeOfCreation"
        ></TemplateCoverLetter>
        <button @click="selectLetterModel(letter)">
          Sélectionner le modèle
        </button>
      </section>
    </div>
    <form v-if="currentStep === 'infos-personnelles'">
      <div class="forms">
        <div class="infos-perso">
          <div class="field">
            <label for="lastnameSender">Nom </label>
            <input
              type="text"
              name="lastnameSender"
              id="lastnameSender"
              v-model="lastnameSender"
              required
            />
          </div>
          <div class="field">
            <label for="firstnameSender">Prénom </label>
            <input
              type="text"
              name="firstnameSender"
              id="firstnameSender"
              v-model="firstnameSender"
              required
            />
          </div>

          <div class="field">
            <label for="mailAddressSender">Adresse-email </label>
            <input
              type="email"
              name="mailAddressSender"
              id="mailAddressSender"
              v-model="mailAddressSender"
            />
          </div>
          <div class="field">
            <label for="phoneNumberSender">Téléphone </label>
            <input
              type="tel"
              name="phoneNumberSender"
              id="phoneNumberSender"
              v-model="phoneNumberSender"
            />
          </div>
          <div class="field">
            <label for="postalAddressSender">Adresse postale </label>
            <input
              type="text"
              name="postalAddressSender"
              id="postalAddressSender"
              v-model="postalAddressSender"
            />
          </div>
          <div class="field">
            <label for="zipCodeSender">Code postal </label>
            <input
              type="number"
              name="zipCodeSender"
              id="zipCodeSender"
              v-model="zipCodeSender"
            />
          </div>
          <div class="field">
            <label for="citySender">Ville </label>
            <input
              type="text"
              name="citySender"
              id="citySender"
              v-model="citySender"
            />
          </div>
        </div>
        <div class="infos-compagny">
          <div class="field">
            <label for="lastnameReceiver">Nom </label>
            <input
              type="text"
              name="lastnameReceiver"
              id="lastnameReceiver"
              v-model="lastnameReceiver"
              required
            />
          </div>
          <div class="field">
            <label for="firstnameReceiver">Prénom </label>
            <input
              type="text"
              name="firstnameReceiver"
              id="firstnameReceiver"
              v-model="firstnameReceiver"
              required
            />
          </div>
          <div class="field">
            <label for="nameCompany">Nom de l'entreprise </label>
            <input
              type="text"
              name="nameCompany"
              id="nameCompany"
              v-model="nameCompany"
              required
            />
          </div>
          <div class="field">
            <label for="postalAddressReceiver">Adresse postale </label>
            <input
              type="text"
              name="postalAddressReceiver"
              id="postalAddressReceiver"
              v-model="postalAddressReceiver"
            />
          </div>
          <div class="field">
            <label for="zipCodeReceiver">Code postal </label>
            <input
              type="number"
              name="zipCodeReceiver"
              id="zipCodeReceiver"
              v-model="zipCodeReceiver"
            />
          </div>
          <div class="field">
            <label for="cityReceiver">Ville </label>
            <input
              type="text"
              name="cityReceiver"
              id="cityReceiver"
              v-model="cityReceiver"
            />
          </div>
        </div>
        <div class="content-letter">
          <div class="field">
            <label for="object">Object </label>
            <input
              type="text"
              name="object"
              id="object"
              v-model="object"
              placeholder="Object"
            />
          </div>
          <div class="field">
            <label for="dateOfCreation">Date de création </label>
            <input
              type="date"
              name="dateOfCreation"
              id="dateOfCreation"
              v-model="dateOfCreation"
              required
            />
          </div>
          <div class="field">
            <label for="placeOfCreation">Lieu de création </label>
            <input
              type="text"
              name="placeOfCreation"
              id="placeOfCreation"
              v-model="placeOfCreation"
              required
            />
          </div>
          <div class="field">
            <textarea v-model="text" placeholder="Text">Texte </textarea>
          </div>
        </div>
      </div>

      <div class="preview">
        <TemplateCoverLetter
          :name="selectedLetterModel.coverLetter.name"
          :firstnameSender="firstnameSender"
          :lastnameSender="lastnameSender"
          :mailAddressSender="mailAddressSender"
          :phoneNumberSender="phoneNumberSender"
          :postalAddressSender="postalAddressSender"
          :zipCodeSender="zipCodeSender"
          :citySender="citySender"
          :firstnameReceiver="firstnameReceiver"
          :lastnameReceiver="lastnameReceiver"
          :nameCompany="nameCompany"
          :postalAddressReceiver="postalAddressReceiver"
          :zipCodeReceiver="zipCodeReceiver"
          :cityReceiver="cityReceiver"
          :object="object"
          :dateOfCreation="dateOfCreation"
          :placeOfCreation="placeOfCreation"
          :text="text"
        ></TemplateCoverLetter>
      </div>
      <button @click.prevent="previewLetter">Enregistrer</button>
    </form>
    <div v-if="currentStep === 'telecharger'">
      <TemplateCoverLetter
        :name="selectedLetterModel.coverLetter.name"
        :firstnameSender="firstnameSender"
        :lastnameSender="lastnameSender"
        :mailAddressSender="mailAddressSender"
        :phoneNumberSender="phoneNumberSender"
        :postalAddressSender="postalAddressSender"
        :zipCodeSender="zipCodeSender"
        :citySender="citySender"
        :firstnameReceiver="firstnameReceiver"
        :lastnameReceiver="lastnameReceiver"
        :nameCompany="nameCompany"
        :postalAddressReceiver="postalAddressReceiver"
        :zipCodeReceiver="zipCodeReceiver"
        :cityReceiver="cityReceiver"
        :object="object"
        :dateOfCreation="dateOfCreation"
        :placeOfCreation="placeOfCreation"
        :text="text"
      ></TemplateCoverLetter>
      <button @click.prevent="downloadPDF">Télécharger en PDF</button>
    </div>
    <div class="btns">
      <button>Etape précédente</button>
      <button>Etape suivante</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { useCoverLetterStore } from "../stores/coverLetter";
import TemplateCoverLetter from "../components/TemplateCoverLetter.vue";
import cookies from 'vue-cookies';

export default {
  components: {
    TemplateCoverLetter,
  },
  data() {
    return {
      coverLetterModels: [],
      selectedLetterModel: null,
      currentStep: "choix-template",
      firstnameSender: "",
      lastnameSender: "",
      mailAddressSender: "",
      phoneNumberSender: "",
      postalAddressSender: "",
      zipCodeSender: "",
      citySender: "",
      firstnameReceiver: "",
      lastnameReceiver: "",
      nameCompany: "",
      postalAddressReceiver: "",
      zipCodeReceiver: "",
      cityReceiver: "",
      object: "",
      dateOfCreation: "",
      placeOfCreation: "",
      text: "",
    };
  },
  mounted() {
    this.getCoverLetterModels();
    this.loadDataFromCookies();
  },
  methods: {
    getCoverLetterModels() {
      axios
        .get("/api/lettres-de-motivation")
        .then((response) => {
          console.log(response.data);
          this.coverLetterModels = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeStep(step) {
      this.currentStep = step;
    },
    selectLetterModel(letterModel) {
      this.selectedLetterModel = letterModel;
      // Affecter la template sélectionnée au store
      useCoverLetterStore().selectedTemplate = letterModel.coverLetter;
      // Réinitialiser les champs d'information du store
      useCoverLetterStore().reset();
      // Passer à l'étape suivante (2)
      this.currentStep = "infos-personnelles";
    },
    //Sauvegarder les données dans les cookies
    saveDataToCookies() {
    const store = useCoverLetterStore();
    cookies.set('firstnameSender', store.firstnameSender);
    cookies.set('lastnameSender', store.lastnameSender);
    cookies.set('mailAddressSender', store.mailAddressSender);
    cookies.set('phoneNumberSender', store.phoneNumberSender);
    cookies.set('postalAddressSender', store.postalAddressSender);
    cookies.set('zipCodeSender', store.zipCodeSender);
    cookies.set('citySender', store.citySender);

    cookies.set('firstnameReceiver', store.firstnameReceiver);
    cookies.set('lastnameReceiver', store.lastnameReceiver);
    cookies.set('nameCompany', store.nameCompany);
    cookies.set('postalAddressReceiver', store.postalAddressReceiver);
    cookies.set('zipCodeReceiver', store.zipCodeReceiver);
    cookies.set('citySender', store.citySender);

    cookies.set('object', store.object);
    cookies.set('dateOfCreation', store.dateOfCreation);
    cookies.set('placeOfCreation', store.placeOfCreation);
    cookies.set('text', store.text);


  },
  //Charger les données depuis les cookies lorsque l'on recharge la page
  loadDataFromCookies() {
    this.firstnameSender = cookies.get('firstnameSender');
    this.lastnameSender = cookies.get('lastnameSender');
    this.mailAddressSender = cookies.get('mailAddressSender');
    this.phoneNumberSender = cookies.get('phoneNumberSender');
    this.postalAddressSender = cookies.get('postalAddressSender');
    this.zipCodeSender = cookies.get('zipCodeSender');
    this.citySender = cookies.get('citySender');

    this.firstnameReceiver = cookies.get('firstnameReceiver');
    this.lastnameReceiver = cookies.get('lastnameReceiver');
    this.nameCompany = cookies.get('nameCompany');
    this.postalAddressReceiver = cookies.get('postalAddressReceiver');
    this.zipCodeReceiver = cookies.get('zipCodeReceiver');
    this.cityReceiver = cookies.get('cityReceiver');

    this.object = cookies.get('object');
    this.dateOfCreation = cookies.get('dateOfCreation');
    this.dateOfCreation = cookies.get('dateOfCreation');
    this.placeOfCreation = cookies.get('placeOfCreation');
    this.text = cookies.get('text');
  },
    previewLetter() {
      //stocker les informations dans le store
      const store = useCoverLetterStore();
      const selectedTemplate = this.selectedLetterModel.coverLetter;
      store.setFirstnameSender(this.firstnameSender);
      store.setLastnameSender(this.lastnameSender);
      store.setMailAddressSender(this.mailAddressSender);
      store.setPhoneNumberSender(this.phoneNumberSender);
      store.setPostalAddressSender(this.postalAddressSender);
      store.setZipCodeSender(this.zipCodeSender);
      store.setCitySender(this.citySender);

      store.setFirstnameReceiver(this.firstnameReceiver);
      store.setLastnameReceiver(this.lastnameReceiver);
      store.setNameCompany(this.nameCompany);
      store.setPostalAddressReceiver(this.postalAddressReceiver);
      store.setZipCodeReceiver(this.zipCodeReceiver);
      store.setCityReceiver(this.cityReceiver);

      store.setObject(this.object);
      store.setDateOfCreation(this.dateOfCreation);
      store.setPlaceOfCreation(this.placeOfCreation);
      store.setText(this.text);

      // Passer à l'étape suivante (3)
      this.saveDataToCookies();
      this.currentStep = "telecharger";
    },

    downloadPDF() {
      const store = useCoverLetterStore();
      const {
        firstnameSender,
        lastnameSender,
        mailAddressSender,
        phoneNumberSender,
        postalAddressSender,
        zipCodeSender,
        citySender,
        firstnameReceiver,
        lastnameReceiver,
        nameCompany,
        postalAddressReceiver,
        zipCodeReceiver,
        cityReceiver,
        object,
        dateOfCreation,
        placeOfCreation,
        text,
      } = store;

      // Utilisez les données du store pour générer le PDF

      store.reset();
      this.currentStep = "choix-template";
    },
  },
};
</script>
