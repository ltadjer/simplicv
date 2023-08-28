<template>
  <div class="contact container mx-auto flex justify-center items-center h-screen flex-col">
    <h1 class="text-4xl md:text-5xl text-center gap-5 text-blue pt-3 pb-3">Contactez-nous</h1>
    <p class="text-center py-2">Si vous avez une question, n'hésitez pas à nous écrire.</p>
    <form @submit.prevent="submitForm" class="w-[80%] md:w-2/5 py-8">
      <MyInput
        label="Nom"
        type="text"
        inputName="lastname"
        :inputValue="lastname"
        @update:value="lastname = $event"
        :InputPlaceholder="Dupont"
        :required="required"
      />
      <MyInput
        label="Prénom"
        type="text"
        inputName="firstname"
        :inputValue="firstname"
        @update:value="firstname = $event"
        :InputPlaceholder="John"
        :required="required"
      />
      <MyInput
        label="Adresse email"
        type="email"
        inputName="email"
        :inputValue="email"
        @update:value="email = $event"
        :required="required"
      />
      <MyInput
        label="Sujet"
        type="text"
        inputName="subject"
        :inputValue="subject"
        @update:value="subject = $event"
        :required="required"
      />
      <MyInput
        label="Message"
        type="textarea"
        inputName="message"
        :inputValue="message"
        @update:value="message = $event"
        :required="required"
      />
      <div v-if="showNotification" class="message bg-green text-white px-6 py-3 shadow-lg shadow-green-500 rounded-lg">{{ notification }}</div>
      <MyButton class="block mx-auto my-4" type="submit">Envoyer</MyButton>
    </form>
  </div>
</template>
  
  <script>
import axios from "axios";
import MyForm from "../components/form/MyForm.vue";
import MyInput from "../components/form/MyInput.vue";
import MyButton from "../components/MyButton";

export default {
  name: "Contact",
  components: {
    MyForm,
    MyInput,
    MyButton,
  },
  data() {
    return {
      lastname: "",
      firstname: "",
      email: "",
      subject: "",
      message: "",
      showMessage: false, // Ajout de la propriété pour afficher ou masquer le message
    };
  },
  methods: {
    submitForm() {
      this.notification = "";
      this.showNotification = false;
      // Créer une instance de URLSearchParams pour stocker les données du formulaire
      //RLSearchParams est une interface JavaScript intégrée qui permet de gérer les données d'une requête URL sous la forme de paires clé-valeur.
      const formData = new URLSearchParams();

      // Ajouter les champs du formulaire à l'instance de URLSearchParams
      formData.append("lastname", this.lastname);
      formData.append("firstname", this.firstname);
      formData.append("email", this.email);
      formData.append("subject", this.subject);
      formData.append("message", this.message);
      // Afficher le message de succès

      // Envoyer la requête POST à votre API Symfony avec les données du formulaire
      axios
        .post("/api/contact", formData)
        .then((response) => {
          // Réponse réussie de l'API Symfony
          console.log(response.data);
          // Réinitialiser les valeurs du formulaire
          this.lastname = "";
          this.firstname = "";
          this.email = "";
          this.subject = "";
          this.message = "";
          this.notification = "Votre message a bien été envoyé";
          this.showNotification = true;
        })
        .catch((error) => {
          // Erreur lors de l'appel à l'API Symfony
          console.error(error);

          this.notification = "Une erreur s'est produite. Veuillez réessayer.";
          this.showNotification = true;
        });
    },
  },
};
</script>
