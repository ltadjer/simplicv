import { defineStore } from "pinia";

export const useCoverLetterStore = defineStore("coverLetter", {
  state: () => ({
    selectedTemplate: null,
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
    text: "",
    dateOfCreation: "",
    placeOfCreation: ""
  }),
  actions: {
    setFirstnameSender(firstnameSender) {
      this.firstnameSender = firstnameSender;
    },
    setLastnameSender(lastnameSender) {
      this.lastnameSender = lastnameSender;
    },
    setMailAddressSender(mailAddressSender) {
      this.mailAddressSender = mailAddressSender;
    },
    setPhoneNumberSender(phoneNumberSender) {
      this.phoneNumberSender = phoneNumberSender;
    },
    setPostalAddressSender(postalAddressSender) {
      this.postalAddressSender = postalAddressSender;
    },
    setZipCodeSender(zipCodeSender) {
      this.zipCodeSender = zipCodeSender;
    },
    setCitySender(citySender) {
      this.citySender = citySender;
    },
    setFirstnameReceiver(firstnameReceiver) {
      this.firstnameReceiver = firstnameReceiver;
    },
    setLastnameReceiver(lastnameReceiver) {
      this.lastnameReceiver = lastnameReceiver;
    },
    setNameCompany(nameCompany) {
      this.nameCompany = nameCompany;
    },
    setPostalAddressReceiver(postalAddressReceiver) {
      this.postalAddressReceiver = postalAddressReceiver;
    },
    setZipCodeReceiver(zipCodeReceiver) {
      this.zipCodeReceiver = zipCodeReceiver;
    },
    setCityReceiver(cityReceiver) {
      this.cityReceiver = cityReceiver;
    },
    setObject(object) {
      this.object = object;
    },
    setDateOfCreation(dateOfCreation) {
      this.dateOfCreation = dateOfCreation;
    },
    setPlaceOfCreation(placeOfCreation) {
      this.placeOfCreation = placeOfCreation;
    },
    setText(text) {
      this.text = text;
    },
    reset() {
      this.firstnameSender = "";
      this.lastnameSender = "";
      this.mailAddressSender = "";
      this.phoneNumberSender = "";
      this.postalAddressSender = "";
      this.zipCodeSender = "";
      this.citySender = "";
      this.firstnameReceiver = "";
      this.lastnameReceiver = "";
      this.nameCompany = "";
      this.postalAddressReceiver = "";
      this.zipCodeReceiver = "";
      this.cityReceiver = "";
      this.object = "";
      this.dateOfCreation = "";
      this.placeOfCreation = "";
      this.text = "";
    },
  },
});
