  <template>
      <article  :id="id" class="cv-template-a4"
          :style="{
            color: textColor,
            fontFamily: textFont, 
          }">
      <div class="flex h-full">
        <div
          class="w-1/4 p-4"
          :style="{
            backgroundColor: bgColor,
          }"
        >
          <div class="mt-4">
            <div>
              <img
              :src="getImageSrc()"
                alt="Profile Image"
                class="w-24 h-24 rounded-full mx-auto mb-4"
              />
            </div>
            <div class="flex items-start mb-4">
              <i class="fas fa-envelope mr-2"></i>
              <p class="text-sm">{{ mailAddress }}</p>
            </div>
            <div class="flex items-start mb-4">
              <i class="fas fa-calendar-alt mr-2"></i>
              <p class="text-sm">{{ formatDateBirth(dateOfBirth) }}</p>
            </div>
            <div class="flex items-start mb-4">
              <i class="fas fa-phone-alt mr-2"></i>
              <p class="text-sm">{{ phoneNumber }}</p>
            </div>
            <div class="flex items-start mb-4">
              <i class="fas fa-map-marker-alt mr-2"></i>
              <p class="text-sm">{{ postalAddress }}, {{ zipCode }} {{ city }}</p>
            </div>
            <div class="flex items-start mb-4">
              <i class="fas fa-id-card mr-2"></i>
              <p class="text-sm">{{ drivingLicence }}</p>
            </div>
          </div>
        </div>
        <div class="w-3/4 bg-white p-4">
          <p class="text-3xl font-bold">{{ firstname }} {{ lastname }}</p>
          <p class="text-xl font-bold" :style="{ color: titleColor }">{{ title }}</p>
          <p class="mt-4">{{ description }}</p>

          <section class="mt-4">
            <h3 class="text-lg font-bold" :style="{ color: titleColor }">Formations</h3>
            <ul class="mt-4 timeline">
          <li v-for="formation in formations" :key="formation.id" class="mb-4">
            <div class="timeline-item">
              <div class="timeline-item-marker" :style="{ backgroundColor: textColor }"></div>
              <div class="timeline-item-content">
                <p class="text-md font-bold">{{ formation.degree }}</p>
                <p class="text-sm">
                  De <span class="font-bold">{{ formatDate(formation.startDate) }}</span> à
                  <span class="font-bold">{{ formatDate(formation.endDate) }}</span> - {{ formation.nameSchool }} -
                  {{ formation.locationSchool }}
                </p>
                <p class="text-sm">{{ formation.description }}</p>
              </div>
            </div>
          </li>
        </ul>
          </section>
          <section class="mt-4">
          <h3 class="text-lg font-bold" :style="{ color: titleColor }">Expériences</h3>
          <ul class="mt-4 timeline">
            <li v-for="experience in experiences" :key="experience.id" class="mb-4">
              <div class="timeline-item">
                <div class="timeline-item-marker" :style="{ backgroundColor: textColor }"></div>
                <div class="timeline-item-content">
                  <p class="text-md font-bold">{{ experience.jobTitle }}</p>
                  <p class="text-sm">
                    De <span class="font-bold">{{ formatDate(experience.startDate) }}</span> à
                    <span class="font-bold">{{ formatDate(experience.endDate) }}</span> - {{ experience.employer }} -
                    {{ experience.city }}
                  </p>
                  <p class="text-sm">{{ experience.description }}</p>
                </div>
              </div>
            </li>
          </ul>
        </section>
          <section class="mt-4">
            <h3 class="text-lg font-bold" :style="{ color: titleColor }">Compétences</h3>
            <ul class="mt-4">
              <li v-for="skill in skills" :key="skill.id">{{ skill.name }}</li>
            </ul>
          </section>
          <section class="mt-4">
            <h3 class="text-lg font-bold" :style="{ color: titleColor }">Langues</h3>
            <ul class="mt-4">
              <li v-for="language in languages" :key="language.id">
                {{ language.name }}
              </li>
            </ul>
          </section>
          <section class="mt-4">
            <h3 class="text-lg font-bold" :style="{ color: titleColor }">Réseaux sociaux</h3>
            <ul class="mt-4">
              <li
                v-for="socialMedia in socialMedias"
                :key="socialMedia.id"
                class="flex items-center"
              >
              <i :class="['fab', 'fa-' + (socialMedia.name ? socialMedia.name.toLowerCase() : '')]"></i>
                <span class="ml-2">@{{ socialMedia.pseudo }}</span>
              </li>
            </ul>
          </section>
        </div>
      </div>
    </article>  
  </template>

  <script>
  export default {
    props: {
      id: String,
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
      bgColor: String,
      textColor: String,
      textFont: String,
      titleFont: String,
      titleColor: String,
      imageFromForm: String,
      image: String,
    },
    methods: {
      formatDate(date) {
        const options = { year: "numeric", month: "long" };
        return new Date(date).toLocaleDateString(undefined, options);
      },

      formatDateBirth(date) {
        const options = { year: "numeric", month: "long", day: "numeric" };
        return new Date(date).toLocaleDateString(undefined, options);
      },

      getImageSrc() {
        // Si imageFromBDD est disponible, renvoyer le chemin avec /images/profils/

        if (this.imageFromForm) {
          return this.imageFromForm;
        }
        
        if (this.image) {
          return `/images/profils/${this.image}`;
        }

        // Sinon, si image est disponible, renvoyer le chemin de l'image sélectionnée par l'utilisateur
      

    },
    },

    mounted() {
      // Définir la couleur de la timeline dynamiquement
      document.documentElement.style.setProperty('--timeline-color', this.textColor);
    },
  };
  </script>

  <style>

  .cv-template-a4 {
    width: 210mm;
    height: 297mm;
    margin: 20mm auto;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  .cv-template-a4 i {
    font-size: 1.2rem;
    margin-right: 0.5rem;
  }

  .timeline {
    position: relative;
  }

  .timeline::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 24px;
    width: 2px;
    background-color:black; /*a voir comment rendre cette valeur dynamique avec textColor*/

  }

  .timeline-item {
    display: flex;
    align-items: flex-start;
    position: relative;
    margin-left: 20px;
    padding-left: 24px;
  }

  .timeline-item-marker {
    position: absolute;
    top: 0;
    left: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
  }

  .timeline-item-content {
    margin-top: 2px;
  }

  /* Styles spécifiques à l'impression

  Faut que je modifie*/

  @media print {
    .cv-template-a4 {
      width: 210mm;
      height: 297mm;
      margin: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
      padding: 20mm;
    }

    /* Ajustement de la bande de couleur latérale */
    .side-bar {
      width: 20mm;
      background-color: #333;
    }

    /* Ajustement de la largeur des sections */
    .w-1/4, .w-3/4 {
      width: auto;
    }

    /* Ajustement de la taille de l'image de profil */
    .w-24, .h-24 {
      width: 64px;
      height: 64px;
    }

    /* Ajustement de la taille des icônes */
    .fas {
      font-size: 12px;
    }

    /* ... Autres ajustements de style si nécessaire ... */
  }
  </style>
