<template>
  <div>
  <TemplateCoverLetter
          :object="letter.coverLetter?.object"
          :text="letter.coverLetter?.text"
          :firstnameSender="letter.coverLetter?.firstnameSender"
          :lastnameSender="letter.coverLetter?.lastnameSender"
          :mailAddressSender="letter.coverLetter?.mailAddressSender"
          :phoneNumberSender="letter.coverLetter?.phoneNumberSender"
          :postalAddressSender="letter.coverLetter?.postalAddressSender"
          :zipCodeSender="letter.coverLetter?.zipCodeSender"
          :citySender="letter.coverLetter?.citySender"
          :firstnameReceiver="letter.coverLetter?.firstnameReceiver"
          :lastnameReceiver="letter.coverLetter?.lastnameReceiver"
          :nameCompany="letter.coverLetter?.nameCompany"
          :postalAddressReceiver="letter.coverLetter?.postalAddressReceiver"
          :zipCodeReceiver="letter.coverLetter?.zipCodeReceiver"
          :cityReceiver="letter.coverLetter?.cityReceiver"
          :dateOfCreation="letter.coverLetter?.dateOfCreation"
          :placeOfCreation="letter.coverLetter?.placeOfCreation"
        ></TemplateCoverLetter>
        </div>
</template>

<script>
import axios from 'axios';
import TemplateCoverLetter from "../components/TemplateCoverLetter.vue";

export default {
  components: {
    TemplateCoverLetter,
  },
  data() {
    return {
      letter: {}, // Initialise avec un objet vide
    };
  },
  mounted() {
    this.fetchLetter();
  },
  methods: {
    async fetchLetter() {
      try {
        const slug = this.$route.params.slug;  // Remplacez par le slug réel du CV
        const response = await axios.get(`/api/modeles-de-lettres/${slug}`);
        this.letter = response.data;
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
