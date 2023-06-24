<template>
  <div>
    <div>{{ name }}</div>
    <div>
      <div class="profil">
        <h3>Profils</h3>
        <div v-for="profil in profils" :key="profil.id">
          <p>{{ profil.dateOfBirth }}</p>
          <p>{{ profil.phoneNumber }}</p>
          <p>{{ profil.postalAddress }}</p>
        </div>
      </div>
    </div>

    <div class="formations">
      <h3>Formations</h3>
      <ul>
        <li v-for="formation in formations" :key="formation.id">
          {{ formation.degree }} - {{ formation.nameSchool }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    formations: Array,
    profils: Array,
  },
};
</script>
