<template>
  <div class="home">
    <h2>Modèles de lettre de motivation</h2>
    <ul>
      <div v-for="model in coverLetterModels" :key="model.id">
        <h3>{{ model.coverLetterModel.name }}</h3>
        <div :style="{ fontFamily: model.coverLetterModel.textFont, color: model.coverLetterModel.textColor }">
          <p v-html="model.text"></p>
        </div>
      </div>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      coverLetterModels: []
    }
  },
  mounted() {
    this.getCoverLetterModel()
  },
  methods: {
    getCoverLetterModel() {
      axios
        .get('http://127.0.0.1:8000/api/lettres-de-motivations')
        .then((response) => {
          console.log(response.data)
          this.coverLetterModels = response.data
        })
        .catch((error) => {
          console.log(error)
        })
    }
  }
}
</script>
