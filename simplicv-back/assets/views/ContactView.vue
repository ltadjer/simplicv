<template>
  <div class="contact">
    <h1 class="text-orange">Contact Us</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label for="lastname">Last Name:</label>
        <input
          type="text"
          id="lastname"
          v-model="lastname"
          name="lastname"
          required
        />
      </div>
      <div>
        <label for="firstname">First Name:</label>
        <input
          type="text"
          id="firstname"
          v-model="firstname"
          name="firstname"
          required
        />
      </div>
      <div>
        <label for="email">Email:</label>
        <input
          type="email"
          id="email"
          v-model="email"
          name="email"
          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
          required
        />
  
      </div>
      <div>
        <label for="subject">Subject:</label>
        <input
          type="text"
          id="subject"
          v-model="subject"
          name="subject"
          required
        />
      </div>
      <div>
        <label for="message">Message:</label>
        <textarea
          id="message"
          v-model="message"
          name="message"
          required
        ></textarea>
      </div>
      <div v-if="showNotification" class="message">{{ notification }}</div>
      <button type="submit">Envoyer</button>
    </form>
  </div>
</template>
  
  <script>
import axios from "axios";

export default {
  name: "Contact",
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
        .post("http://localhost:8000/api/contact", formData)
        .then((response) => {
          // Réponse réussie de l'API Symfony
          console.log(response.data);
          // Réinitialiser les valeurs du formulaire
          this.lastname = "";
          this.firstname = "";
          this.email = "";
          this.subject = "";
          this.message = "";
          this.notification = "Message envoyé !";
          this.showNotification = true;
        })
        .catch((error) => {
          // Erreur lors de l'appel à l'API Symfony
          console.error(error);

          this.notification = "Une erreur s'est produite. Veuillez réessayer.";
          this.showNotification = true;
        });
    }
  },
};
</script>
