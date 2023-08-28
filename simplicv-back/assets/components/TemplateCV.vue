  <template>
  <article
    :id="id"
    class="cv-template-a4"
    :class="[
      'cv-template-a4',
      { 'other-template-class': !useTemplateA4 },
      { 'mobile-template': useMobileTemplate }
    ]"
    :style="{
      color: textColor,
      fontFamily: textFont,
      width: useMobileTemplate ? '89mm' : (useTemplateA4 ? '210mm' : '150mm'),
      height: useMobileTemplate ? '124mm' : (useTemplateA4 ? '297mm' : '180mm'),
      margin: useMobileTemplate ? '5mm auto' : (useTemplateA4 ? '20mm auto' : '10mm auto'),
      boxSizing: 'border-box',
    }"
  >
    <div class="flex h-full">
      <div
        class="w-[30%]"
        :class="useMobileTemplate ? 'p-2' : (useTemplateA4 ? 'p-4' : 'p-4')"
        :style="{
          backgroundColor: bgColor,
        }"
      >
        <div :class="useMobileTemplate ? 'mt-2' : (useTemplateA4 ? 'mt-4' : 'mt-4')">
          <div>
            <img
              :src="getImageSrc()"
              alt="Profile Image"
              class="rounded-full mx-auto"
              :class="useMobileTemplate ? 'w-16 h-16 mb-3' : (useTemplateA4 ? 'w-24 h-24 mb-6' : 'w-24 h-24 mb-6')"
            />
          </div>
          <div class="flex items-start"  :class="useMobileTemplate ? 'mb-2' : (useTemplateA4 ? 'mb-6' : 'mb-6')">
            <i
              class="fas fa-envelope mr-2"
              :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-lg' : 'text-sm')"
            ></i>
            <p :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
              {{ mailAddress }}
            </p>
          </div>
          <div class="flex items-start" :class="useMobileTemplate ? 'mb-2' : (useTemplateA4 ? 'mb-6' : ' mb-6')">
            <i
              class="fas fa-calendar-alt mr-2"
              :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-lg' : 'text-sm')"
            ></i>
            <p :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
              {{ formatDateBirth(dateOfBirth) }}
            </p>
          </div>
          <div
            class="flex items-start" :class="useMobileTemplate ? 'mb-2' : (useTemplateA4 ? 'mb-6' : ' mb-6')">
            <i class="fas fa-phone-alt mr-2" :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-lg' : 'text-sm')"
></i>
            <p :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
              {{ phoneNumber }}
            </p>
          </div>
          <div
            class="flex items-start"
            :class="useMobileTemplate ? 'mb-2' : (useTemplateA4 ? 'mb-6' : ' mb-6')"
          >
            <i class="fas fa-map-marker-alt mr-2" :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-lg' : 'text-sm')"
></i>
            <p  :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
              {{ postalAddress }}, {{ zipCode }} {{ city }}
            </p>
          </div>
          <div
            class="flex items-start"
            :class="useMobileTemplate ? 'mb-2' : (useTemplateA4 ? 'mb-6' : ' mb-6')"
          >
            <i
              class="fas fa-id-card mr-2"
              :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-lg' : 'text-sm')"
            ></i>
            <p  :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
              {{ drivingLicence }}
            </p>
          </div>
          <div :class="useMobileTemplate ? 'mb-2 mt-3' : (useTemplateA4 ? 'mb-6 mt-8 ' : ' mb-6 mt-8 ')">
            <h3
              class="font-bold"
              :class="useMobileTemplate ? ' text-[10px]' : (useTemplateA4 ? 'text-lg' : 'text-base')"            
              :style="{ color: titleColor }"
            >
              Langues
            </h3>
            <ul :class="useMobileTemplate ? 'mt-1' : (useTemplateA4 ? 'mt-4' : 'mt-4')">
              <li v-for="language in languages" :key="language.id" :class="useMobileTemplate ? 'text-[8px]' : (useTemplateA4 ? 'text-base' : 'text-base')" >
                {{ language.name }}
              </li>
            </ul>
          </div>
          <div :class="useMobileTemplate ? 'mt-3 mb-2' : (useTemplateA4 ? 'mt-8 mb-6' : 'mt-8 mb-6')">
            <h3
              class="font-bold"
              :class="useMobileTemplate ? 'text-[10px]' : (useTemplateA4 ? 'text-lg' : 'text-base')"            
              :style="{ color: titleColor }"
            >
              Réseaux sociaux
            </h3>
            <ul :class="useMobileTemplate ? 'mt-1' : (useTemplateA4 ? 'mt-4' : 'mt-4')">
              <li
                v-for="socialMedia in socialMedias"
                :key="socialMedia.id"
                class="flex items-center"
                :class="useMobileTemplate ? 'text-[8px]' : (useTemplateA4 ? 'text-base' : 'text-base')"            
              >
                <i
                  :class="[
                    'fab',
                    'fa-' +
                      (socialMedia.name ? socialMedia.name.toLowerCase() : ''),useMobileTemplate ? ' text-[10px]' : (useTemplateA4 ? 'text-lg' : 'text-sm')
                  ]"
                ></i>
                <span class="ml-2">@{{ socialMedia.pseudo }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="w-[70%] bg-white p-4">
        <div>
          <p class="text-bold" :class="useMobileTemplate ? ' text-xs' : (useTemplateA4 ? 'text-3xl' : 'text-xl')">
            {{ firstname }} {{ lastname }}
          </p>
          <p
            class="font-bold"
            :class="useMobileTemplate ? ' text-xs' : (useTemplateA4 ? 'text-xl' : 'text-lg')"
            :style="{ color: titleColor }"
          >
            {{ title }}
          </p>
          <p :class="useMobileTemplate ? ' text-[8px] mt-1' : (useTemplateA4 ? 'text-sm mt-4' : 'text-xs mt-4')">
            {{ description }}
          </p>
          <hr :class="useMobileTemplate ? 'my-3' : (useTemplateA4 ? 'my-6' : 'my-6')" />
        </div>

        <section :class="useMobileTemplate ? 'my-3' : (useTemplateA4 ? 'my-6' : 'my-6')">
          <h3
            class="font-bold"
            :class="useMobileTemplate ? ' text-[12px]' : (useTemplateA4 ? 'text-lg' : 'text-base')"            
            :style="{ color: titleColor }"
          >
            Formations
          </h3>
          <ul class="timeline" :class="useMobileTemplate ? 'mt-2' : (useTemplateA4 ? 'mt-4' : 'mt-4')">
            <li
              v-for="formation in formations"
              :key="formation.id"
              :class="useMobileTemplate ? 'mt-2' : (useTemplateA4 ? 'mt-4' : 'mt-4')"
            >
              <div class="timeline-item">
                <div
                  class="timeline-item-marker"
                  :style="{ backgroundColor: textColor }"
                ></div>
                <div class="timeline-item-content">
                  <p
                    class="font-bold"
                    :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-md' : 'text-sm')"
                  >
                    {{ formation.degree }}
                  </p>
                  <p :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
                    De
                    <span class="font-bold">{{
                      formatDate(formation.startDate)
                    }}</span>
                    à
                    <span class="font-bold">{{
                      formatDate(formation.endDate)
                    }}</span>
                    - {{ formation.nameSchool }} {{ formation.locationSchool }}
                  </p>
                  <p  :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
                    {{ formation.description }}
                  </p>
                </div>
              </div>
            </li>
          </ul>
        </section>
        <section :class="useMobileTemplate ? 'my-3' : (useTemplateA4 ? 'my-6' : 'my-6')">
          <h3
            class="font-bold"
            :class="useMobileTemplate ? ' text-[12px]' : (useTemplateA4 ? 'text-lg' : 'text-base')"            
            :style="{ color: titleColor }"
          >
            Expériences
          </h3>
          <ul class="timeline" :class="useMobileTemplate ? 'mt-2' : (useTemplateA4 ? 'mt-4' : 'mt-4')">
            <li
              v-for="experience in experiences"
              :key="experience.id"
              :class="useMobileTemplate ? 'mt-2' : (useTemplateA4 ? 'mt-4' : 'mt-4')"
            >
              <div class="timeline-item">
                <div
                  class="timeline-item-marker"
                  :style="{ backgroundColor: textColor }"
                ></div>
                <div class="timeline-item-content">
                  <p
                    class="font-bold"
                    :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-md' : 'text-sm')"
                  >
                    {{ experience.jobTitle }}
                  </p>
                  <p  :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
                    De
                    <span class="font-bold">{{
                      formatDate(experience.startDate)
                    }}</span>
                    à
                    <span class="font-bold">{{
                      formatDate(experience.endDate)
                    }}</span>
                    - {{ experience.employer }} {{ experience.city }}
                  </p>
                  <p :class="useMobileTemplate ? ' text-[8px]' : (useTemplateA4 ? 'text-sm' : 'text-xs')">
                    {{ experience.description }}
                  </p>
                </div>
              </div>
            </li>
          </ul>
        </section>
        <section :class="useMobileTemplate ? 'my-3' : (useTemplateA4 ? 'my-6' : 'my-6')">
          <h3
            class="font-bold"
            :class="useMobileTemplate ? ' text-[12px]' : (useTemplateA4 ? 'text-lg' : 'text-base')"            
            :style="{ color: titleColor }"
          >
            Compétences
          </h3>
          <ul :class="useMobileTemplate ? 'mt-2' : (useTemplateA4 ? 'mt-4' : 'mt-4')">
            <li :class="useMobileTemplate ? 'text-[10px]' : (useTemplateA4 ? 'text-sm' : 'text-sm')" v-for="skill in skills" :key="skill.id">{{ skill.name }}</li>
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
    useTemplateA4: Boolean,
    useMobileTemplate: Boolean,
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
    document.documentElement.style.setProperty(
      "--timeline-color",
      this.textColor
    );
  },
};
</script>

  <style>
.cv-template-a4 {
  box-sizing: border-box;
}

.timeline {
  position: relative;
}

.timeline::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 24px;
  width: 2px;
  background-color: black; /*a voir comment rendre cette valeur dynamique avec textColor*/
}

.mobile-template .timeline::before {
  left: 10px;
}

.timeline-item {
  display: flex;
  align-items: flex-start;
  position: relative;
  margin-left: 20px;
  padding-left: 24px;
}

.mobile-template .timeline-item {
  margin-left: 8px;
  padding-left: 16px;
}

.timeline-item-marker {
  position: absolute;
  top: 0;
  left: 0;
  width: 10px;
  height: 10px;
  border-radius: 50%;
}

.mobile-template .timeline-item-marker {
  position: absolute;
  top: 0;
  left: 0;
  width: 6px;
  height: 6px;
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
  .w-1/4,
  .w-3/4 {
    width: auto;
  }

  /* Ajustement de la taille de l'image de profil */
  .w-24,
  .h-24 {
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
