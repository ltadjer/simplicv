<template>
  <div class="cv-models">
    <h1>Modèles de CV</h1>

    <div v-for="cv in modelsCV" :key="cv.id">
      <h2>{{ cv.name }}</h2>
      <p>Type: {{ cv.type }}</p>
      <ul>
        <li v-for="profil in cv.profils" :key="profil.id">
          <h3>Profil</h3>
          <!-- <img
              :src={`http://127.0.0.1:8000/images/profils/${profil.image}`}
              alt=""
            /> -->
          <p>Titre: {{ profil.title }}</p>
          <p>Description: {{ profil.description }}</p>

          <p>Prénom: {{ profil.firstname }}</p>
          <p>Nom: {{ profil.lastname }}</p>
          <p>Date de naissance: {{ profil.dateOfBirth }}</p>
          <p>Numéro de téléphone: {{ profil.phoneNumber }}</p>
          <p>Adresse postale: {{ profil.postalAddress }}</p>
          <p>Code postal: {{ profil.zipCode }}</p>
          <p>Ville: {{ profil.city }}</p>
          <p>Permis de conduire: {{ profil.drivingLicence }}</p>
          <p>Adresse e-mail: {{ profil.mailAddress }}</p>
        </li>
        <li v-for="formation in cv.formations" :key="formation.id">
          <h3>Fromations</h3>
          <p>Diplôme: {{ formation.degree }}</p>
          <p>Nom de l'école: {{ formation.nameSchool }}</p>
        </li>
        <li v-for="experience in cv.experiences" :key="experience.id">
          <h3>Expériences</h3>
          <p> {{ experience.jobTitle }}</p>
          <p>{{ experience.employer }}</p>
        </li>
        <li v-for="skill in cv.skills" :key="skill.id">
          <h3>Compétences</h3>
          <p> {{ skill.name }}</p>
        </li>
        <li v-for="language in cv.languages" :key="language.id">
          <h3>Langues</h3>
          <p> {{ language.name }}</p>
        </li>
        <li v-for="socialMedia in cv.socialMedias" :key="socialMedia.id">
          <h3>Réseaux sociaux</h3>
          <p> {{ socialMedia.name }}</p>
        </li>
      </ul>
      <!-- Ajoutez ici les autres propriétés du modèle de CV -->
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      modelsCV: [],
    };
  },
  mounted() {
    this.getModelsCV();
  },
  methods: {
    getModelsCV() {
      axios
        .get("http://127.0.0.1:8000/api/modeles-de-cv")
        .then((response) => {
          console.log(response.data);
          this.modelsCV = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>

<style>

</style>
