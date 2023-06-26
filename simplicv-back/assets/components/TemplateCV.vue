<template>
  <article>
    <div>{{ name }}</div>
      <section class="profil">
        <h3>Profil</h3>
        <div>
          <img src="#" alt="">
          <p>{{ title }}</p>
          <p>{{ description }}</p>
          <p>{{ firstname }}</p>
          <p>{{ lastname }}</p>
          <p>{{ mailAddress }}</p>
          <p>{{ dateOfBirth }}</p>
          <p>{{ phoneNumber }}</p>
          <p>{{ postalAddress }}</p>
          <p>{{ zipCode }}</p>
          <p>{{ city }}</p>
          <p>{{ drivingLicence }}</p>  
        </div>
      </section>

    <section class="formations">
      <h3>Formations</h3>
      <ul>
        <li v-for="formation in formations" :key="formation.id">
          <p>{{ formation.degree }} - {{ formation.nameSchool }}</p>
          <br>
          <span>{{formation.startDate}} - {{formation.endDate}}</span>
          <p>{{formation.description}}</p>
        </li>
      </ul>
    </section>
    <section class="experiences">
      <h3>Expériences</h3>
      <ul>
        <li v-for="experience in experiences" :key="experience.id">
          <p>{{ experience.jobTitle }} - {{ experience.employer }} - {{ experience.city }}</p>
          <br>
          <span>{{experience.startDate}} - {{experience.endDate}}</span>
          <p>{{experience.description}}</p>
        </li>
      </ul>
    </section>
    <section class="skills">
      <h3>Compétences</h3>
      <ul>
        <li v-for="skill in skills" :key="skill.id">
          {{ skill.name }}
        </li>
      </ul>
    </section>
    <section class="languages">
      <h3>Langues</h3>
      <ul>
        <li v-for="language in languages" :key="language.id">
          {{ language.name }}
        </li>
      </ul>
    </section>
    <section class="socialMedias">
      <h3>Réseaux sociaux</h3>
      <ul>
        <li v-for="socialMedia in socialMedias" :key="socialMedia.id">
          {{ socialMedia.name }} : {{ socialMedia.link }}
        </li>
      </ul>
    </section>
  </article>
</template>

<script>
export default {
  props: {
    name: String,
    formations: Array,
    experiences: Array,
    skills: Array,
    languages: Array,
    socialMedias: Array,
    dateOfBirth: String,
    phoneNumber: Number,
    title: String,
    description: String,
    firstname: String,
    lastname: String,
    mailAddress: String,
    drivingLicence: String,
    postalAddress: String,
    city: String,
    zipCode: Number,
  },
};
</script>
