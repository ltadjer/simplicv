<template>
    <div class="cv">
      <div class="sidebar">
        <div class="profile">
          <h1>{{ nom }}</h1>
          <p>{{ poste }}</p>
        </div>
        <div class="contact-info">
          <h2>Coordonnées</h2>
          <p><i class="fas fa-map-marker-alt"></i> {{ adresse }}</p>
          <p><i class="fas fa-envelope"></i> {{ email }}</p>
          <p><i class="fas fa-phone-alt"></i> {{ telephone }}</p>
          <div class="social-media">
            <a :href="linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a :href="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
            <a :href="github" target="_blank"><i class="fab fa-github"></i></a>
          </div>
        </div>
        <div class="languages">
          <h2>Langues</h2>
          <ul>
            <li v-for="langue in langues" :key="langue.id">{{ langue.nom }} - {{ langue.niveau }}</li>
          </ul>
        </div>
      </div>
  
      <div class="main-content">
        <div class="section">
          <h2>Expériences</h2>
          <div class="item" v-for="experience in experiences" :key="experience.id">
            <h3>{{ experience.poste }}</h3>
            <p><i class="far fa-calendar-alt"></i> {{ experience.date }}</p>
            <p><i class="fas fa-building"></i> {{ experience.entreprise }}</p>
            <ul>
              <li v-for="tache in experience.taches" :key="tache.id">{{ tache }}</li>
            </ul>
          </div>
        </div>
  
        <div class="section">
          <h2>Formations</h2>
          <div class="item" v-for="formation in formations" :key="formation.id">
            <h3>{{ formation.diplome }}</h3>
            <p><i class="far fa-calendar-alt"></i> {{ formation.date }}</p>
            <p><i class="fas fa-university"></i> {{ formation.etablissement }}</p>
          </div>
        </div>
  
        <div class="section">
          <h2>Compétences</h2>
          <ul>
            <li v-for="competence in competences" :key="competence.id">{{ competence }}</li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'CV',
    data() {
      return {
        nom: 'Jean Dupont',
        poste: 'Développeur Web',
        adresse: '123 Rue du Paradis, 75000 Paris',
        email: 'jean.dupont@example.com',
        telephone: '01 23 45 67 89',
        linkedin: 'https://www.linkedin.com/in/jeandupont',
        twitter: 'https://twitter.com/jeandupont',
        github: 'https://github.com/jeandupont',
        langues: [
          { id: 1, nom: 'Français', niveau: 'Langue maternelle' },
          { id: 2, nom: 'Anglais', niveau: 'Courant' },
          { id: 3, nom: 'Espagnol', niveau: 'Intermédiaire' }
        ],
        experiences: [
          {
            id: 1,
            poste: 'Développeur Web',
            date: 'Mars 2018 - Présent',
            entreprise: 'Société ABC',
            taches: [
              'Conception et développement de sites web',
              'Collaboration avec l\'équipe de développement',
              'Optimisation des performances et de l\'expérience utilisateur'
            ]
          },
          {
            id: 2,
            poste: 'Stagiaire Développeur Web',
            date: 'Janvier 2017 - Mars 2017',
            entreprise: 'Agence XYZ',
            taches: [
              'Assistance dans le développement de sites web',
              'Maintenance et résolution de problèmes',
              'Tests et débogage'
            ]
          }
        ],
        formations: [
          {
            id: 1,
            diplome: 'Licence Informatique',
            date: '2014 - 2017',
            etablissement: 'Université ABC'
          },
          {
            id: 2,
            diplome: 'Baccalauréat Scientifique',
            date: '2014',
            etablissement: 'Lycée XYZ'
          }
        ],
        competences: [
          'HTML5',
          'CSS3',
          'JavaScript',
          'Vue.js',
          'React',
          'Node.js',
          'SQL',
          'Git'
        ]
      };
    }
  };
  </script>
  
  <style>
  .cv {
    display: flex;
    font-family: Arial, sans-serif;
    width: 794px; /* Largeur en pixels pour un format A4 en orientation portrait */
    height: 1123px; /* Hauteur en pixels pour un format A4 en orientation portrait */
    margin: 0 auto;
    padding: 40px;
    background-color: #fff;
    box-sizing: border-box;
  }
  
  .sidebar {
    width: 30%;
    background-color: #333;
    color: #fff;
    padding: 20px;
  }
  
  .sidebar h1 {
    font-size: 24px;
    margin-top: 0;
  }
  
  .sidebar p {
    font-size: 16px;
    margin: 5px 0;
  }
  
  .contact-info h2,
  .languages h2 {
    font-size: 18px;
    margin-bottom: 10px;
  }
  
  .social-media {
    margin-top: 10px;
  }
  
  .social-media a {
    color: #fff;
    margin-right: 5px;
    font-size: 18px;
  }
  
  .main-content {
    width: 70%;
    padding: 20px;
    background: rgb(194, 185, 185);
  }
  
  .main-content h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }
  
  .item h3 {
    font-size: 18px;
    margin-bottom: 5px;
  }
  
  .item p {
    font-size: 16px;
    margin-bottom: 5px;
  }
  
  ul {
    list-style-type: disc;
    margin-left: 20px;
  }
  
  li {
    font-size: 16px;
  }
  
  .fas,
  .far,
  .fab {
    margin-right: 5px;
  }
  </style>
  