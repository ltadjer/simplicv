<template>
  <div>
    <h2>Liste des articles</h2>
    <ul>
      <div v-for="article in articles" :key="article.id">
        <h3>{{ article.name }}</h3>
        <p>{{ article.description }}</p>
      </div>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      articles: [],
    };
  },
  mounted() {
    this.getArticles();
  },
  methods: {
    getArticles() {
  axios.get('http://127.0.0.1:8000/api/articles')
    .then(response => {
      console.log(response.data);
      this.articles = response.data;
    })
    .catch(error => {
      console.log(error);
    });
},

  
  },
};
</script>
