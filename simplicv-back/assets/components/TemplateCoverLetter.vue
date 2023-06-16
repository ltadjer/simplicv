<template>
  <div>
    <div>{{ name }}</div>
    <div>
      <div>
        <p>{{ firstnameSender }}</p>
        <p>{{ lastnameSender }}</p>
        <p>{{ mailAddressSender }}</p>
        <p>{{ phoneNumberSender }}</p>
        <p>{{ postalAddressSender }}</p>
        <p>{{ zipCodeSender }}</p>
        <p>{{ citySender }}</p>
      </div>
      <div>
        <p>{{ firstnameReceiver }}</p>
        <p>{{ lastnameReceiver }}</p>
        <p>{{ nameCompany }}</p>
        <p>{{ postalAddressReceiver }}</p>
        <p>{{ zipCodeReceiver }}</p>
        <p>{{ cityReceiver }}</p>
      </div>
    </div>
    <div>
      <div>
        <p>{{ dateOfCreation }}</p>
        <p>{{ placeOfCreation }}</p>
      </div>
      <h3>{{ object }}</h3>
      <p v-html="sanitizeHTML(text)"></p>
    </div>
  </div>
</template>
  
  <script>

import DOMPurify from "dompurify";

export default {
  props: {
    name: String,
    object: String,
    text: String,
    firstnameSender: String,
    lastnameSender: String,
    mailAddressSender: String,
    phoneNumberSender: Number,
    postalAddressSender: String,
    zipCodeSender: Number,
    citySender: String,
    lastnameReceiver: String,
    nameCompany: String,
    mailAddressReceiver: String,
    postalAddressReceiver: String,
    zipCodeReceiver: Number,
    cityReceiver: String,
    dateOfCreation: String,
    placeOfCreation: String,
  },
  methods: {
    // DOMPurify permet de nettoyer le html passé à v-html avant de l'afficher, réduisant ainsi le risque de vulnérabilités XSS.
    sanitizeHTML(html) {
      return DOMPurify.sanitize(html);
    },
  }
};
</script>
  