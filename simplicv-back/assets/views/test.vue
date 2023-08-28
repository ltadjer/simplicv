<template>
  <div class="cv-models container mx-auto px-3 py-4 md:px-8 md:py-8 pb-12">
    <ol
      class="progress-bar list-decimal md:flex md:justify-center md:items-center gap-4 pt-3 pb-20 text-xl"
    >
      <li
        class="cursor-pointer"
        :class="{
          'active text-blue text-bold': currentStep === 'choix-template',
        }"
        @click="changeStep('choix-template')"
      >
        Choississez votre template <i class="fa-solid fa-chevron-right"></i>
      </li>
      <li
        :class="{
          'active text-blue text-bold': currentStep === 'infos-personnelles',
        }"
        @click="changeStep('infos-personnelles')"
        class="ml-4 cursor-pointer"
      >
        Entrez vos informations <i class="fa-solid fa-chevron-right"></i>
      </li>
      <li
        :class="{ 'active text-blue text-bold': currentStep === 'telecharger' }"
        @click="changeStep('telecharger')"
        class="ml-4 cursor-pointer"
      >
        Télécharger votre CV
      </li>
    </ol>
    <div v-if="currentStep === 'choix-template'" class="relative">
      <div class="md:grid md:grid-cols-3 gap-12 overflow-hidden">
        <section v-for="cv in visibleCvs" :key="cv.id">
          <TemplateCV
            v-if="!cv.cvCaptured"
            :id="'template-' + cv.id"
            :formations="cv.formations"
            :experiences="cv.experiences"
            :languages="cv.languages"
            :skills="cv.skills"
            :socialMedias="cv.socialMedias"
            :name="cv.name"
            :textColor="cv.textColor"
            :bgColor="cv.bgColor"
            :titleColor="cv.titleColor"
            :textFont="cv.textFont"
            :dateOfBirth="cv.profil.dateOfBirth"
            :phoneNumber="cv.profil.phoneNumber"
            :postalAddress="cv.profil.postalAddress"
            :title="cv.profil.title"
            :description="cv.profil.description"
            :firstname="cv.profil.firstname"
            :lastname="cv.profil.lastname"
            :mailAddress="cv.profil.mailAddress"
            :drivingLicence="cv.profil.drivingLicence"
            :city="cv.profil.city"
            :zipCode="cv.profil.zipCode"
            :image="cv.profil.image"
          ></TemplateCV>
          <div
            class="border-contour relative flex justify-center items-center mx-auto shadow-lg hover:border hover:border-orange hover:border-2"
          >
            <img
              :src="cvStore.getCapturedImage(cv.id)"
              alt="Template CV"
              style="width: fit-content; height: auto"
              class="opacity-75"
            />
            <MyButton @click="selectCV(cv)" class="absolute top-1/2">
              Sélectionner le modèle
            </MyButton>
          </div>
        </section>
      </div>

      <button
        class="absolute left-0 top-1/2 transform -translate-y-1/2"
        @click="goToPrevious"
        v-if="currentPage > 0"
      >
      <i class="fa-solid fa-chevron-left text-blue text-2xl"></i>
      </button>

      <button
        class="absolute right-0 top-1/2 transform -translate-y-1/2"
        @click="goToNext"
        v-if="currentPage < totalPages - 1"
      >
      <i class="fa-solid fa-chevron-right "></i>
      </button>
    </div>
    <div
      v-if="currentStep === 'infos-personnelles'"
      class="md:flex md:justify-between md:gap-5"
    >
      <div class="forms md:w-1/2 flex flex-col gap-6">
        <MyForm
          class="infos-perso border-2 border-blue px-6 pt-6 pb-8 rounded-[16px]"
        >
          <h3 class="text-blue text-3xl">Profil</h3>
          <hr class="border-blue mt-2 mb-3" />
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <MyInput
              class="md:col-span-1 mx-auto flex md:justify-center md:items-center"
              type="file"
              inputName="imageFromForm"
              :inputValue="imageFromForm"
              @update:value="imageFromForm = $event"
              @changeImage="handleImageChange"
            />
            <div class="md:col-span-1 self-center">
              <MyInput
                label="Titre"
                type="text"
                inputName="title"
                :inputValue="title"
                @update:value="title = $event"
                :required="true"
                inputId="title"
              />
              <span
                v-if="titleError"
                class="error-message text-sm text-orange"
                >{{ titleError }}</span
              >
            </div>
            <div class="md:col-span-2">
              <MyInput
                label="Description"
                type="textarea"
                inputName="descriptionProfil"
                :inputValue="descriptionProfil"
                @update:value="descriptionProfil = $event"
                :required="true"
              />
              <span
                v-if="descriptionProfilError"
                class="error-message text-sm text-orange"
              >
                {{ descriptionProfilError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Nom"
                type="text"
                inputName="lastname"
                :inputValue="lastname"
                @update:value="lastname = $event"
                :required="true"
              />
              <span
                v-if="lastnameError"
                class="error-message text-sm text-orange"
              >
                {{ lastnameError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Prénom"
                type="text"
                inputName="firstname"
                :inputValue="firstname"
                @update:value="firstname = $event"
                :required="true"
              />
              <span
                v-if="firstnameError"
                class="error-message text-sm text-orange"
              >
                {{ firstnameError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Adresse-email"
                type="email"
                inputName="mailAddress"
                :inputValue="mailAddress"
                @update:value="mailAddress = $event"
                :required="true"
              />
              <span
                v-if="mailAddressError"
                class="error-message text-sm text-orange"
              >
                {{ mailAddressError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Téléphone"
                type="tel"
                inputName="phoneNumber"
                :inputValue="phoneNumber"
                @update:value="phoneNumber = $event"
                :required="true"
              />
              <span
                v-if="phoneNumberError"
                class="error-message text-sm text-orange"
              >
                {{ phoneNumberError }}
              </span>
            </div>
            <MyInput
              class="md:col-span-2"
              label="Adresse postale"
              type="text"
              inputName="postalAddress"
              :inputValue="postalAddress"
              @update:value="postalAddress = $event"
              :required="false"
            />
            <div class="md:col-span-1">
              <MyInput
                label="Code postal"
                type="number"
                inputName="zipCode"
                :inputValue="zipCode"
                @update:value="zipCode = $event"
                :required="true"
              />
              <span
                v-if="zipCodeError"
                class="error-message text-sm text-orange"
              >
                {{ zipCodeError }}
              </span>
            </div>

            <MyInput
              class="md:col-span-1"
              label="Ville"
              type="text"
              inputName="city"
              :inputValue="city"
              @update:value="city = $event"
              :required="true"
            />
            <div class="md:col-span-1">
              <MyInput
                label="Date d'anniversaire"
                type="date"
                inputName="dateOfBirth"
                :inputValue="dateOfBirth"
                @update:value="dateOfBirth = $event"
                :required="false"
              />
              <span
                v-if="dateOfBirthError"
                class="error-message text-sm text-orange"
              >
                {{ dateOfBirthError }}
              </span>
            </div>
            <MyInput
              class="md:col-span-1"
              label="Type de permis"
              type="text"
              inputName="drivingLicence"
              :inputValue="drivingLicence"
              @update:value="drivingLicence = $event"
              :required="false"
            />
            <MyButton
              @click.prevent="saveInfosPersoData"
              class="mx-auto md:col-start-2 py-3"
              >Enregistrer</MyButton
            >
          </div>
        </MyForm>

        <MyForm
          class="formations border-2 border-blue px-6 pt-6 pb-8 rounded-[16px]"
        >
          <h3 class="text-blue text-3xl">Formation scolaire</h3>
          <hr class="border-blue mt-2 mb-3" />
          <p>
            Mettez en avant vos formations si elles sont pertinentes pour le
            poste. Elles peuvent constituer un atout aux yeux des recruteurs.
          </p>
          <div class="displayedFormations" v-if="formations.length > 0">
            <div v-for="(formation, index) in formations" :key="index">
              <hr class="border-blue mt-2 mb-3" />
              <div class="flex justify-between">
                <div>
                  <p class="text-blue">{{ formation.degree }}</p>
                  <span
                    >{{ formatDate(formation.startDate) }} -
                    {{ formatDate(formation.endDate) }}</span
                  >
                </div>
                <div class="flex gap-5">
                  <MyButton
                    :without-background="true"
                    @click.prevent="editFormation(index)"
                    ><i class="fa-solid fa-pen text-orange"></i
                  ></MyButton>
                  <MyButton
                    :without-background="true"
                    @click.prevent="removeFormation(index)"
                    ><i class="fa-solid fa-trash text-orange"></i
                  ></MyButton>
                </div>
              </div>
              <hr class="border-blue mt-2 mt-3" />
            </div>
          </div>
          <div
            v-if="isFormVisible || formations.length === 0"
            class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4"
          >
            <div class="md:col-span-2">
              <MyInput
                label="Diplôme"
                type="text"
                inputName="degree"
                :inputValue="degree"
                @update:value="degree = $event"
                :required="true"
              />
              <span
                v-if="degreeError"
                class="error-message text-sm text-orange"
              >
                {{ degreeError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Nom de l'établissement"
                type="text"
                inputName="nameSchool"
                :inputValue="nameSchool"
                @update:value="nameSchool = $event"
                :required="true"
              />
              <span
                v-if="nameSchoolError"
                class="error-message text-sm text-orange"
              >
                {{ nameSchoolError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Lieu de l'établissement"
                type="text"
                inputName="locationSchool"
                :inputValue="locationSchool"
                @update:value="locationSchool = $event"
                :required="true"
              />
              <span
                v-if="locationSchoolError"
                class="error-message text-sm text-orange"
              >
                {{ locationSchoolError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Date de début"
                type="date"
                inputName="startDateFormation"
                :inputValue="startDateFormation"
                @update:value="startDateFormation = $event"
                :required="true"
              />
              <span
                v-if="startDateFormationError"
                class="error-message text-sm text-orange"
              >
                {{ startDateFormationError }}
              </span>
            </div>
            <div class="md:col-span-1">
              <MyInput
                label="Date de fin"
                type="date"
                inputName="endDateFormation"
                :inputValue="endDateFormation"
                @update:value="endDateFormation = $event"
                :required="true"
              />
              <span
                v-if="endDateFormationError"
                class="error-message text-sm text-orange"
              >
                {{ endDateFormationError }}
              </span>
            </div>
            <MyInput
              class="md:col-span-2"
              label="Description"
              type="textarea"
              inputName="descriptionFormation"
              :inputValue="descriptionFormation"
              @update:value="descriptionFormation = $event"
              :required="false"
            />
            <div class="md:col-span-2 py-3 flex justify-between">
              <MyButton
                :without-background="true"
                v-if="isEditingFormation"
                @click.prevent="clearFormationForm"
                class="bg-background text-orange border-2 border-orange py-3 px-6"
              >
                Supprimer
              </MyButton>
              <MyButton
                @click.prevent="
                  isEditingFormation ? updateFormation() : saveFormationsData()
                "
              >
                Enregistrer
              </MyButton>
            </div>
          </div>
          <MyButton
            :without-background="true"
            @click.prevent="addFormation"
            class="text-blue text-left whitespace-nowrap mt-4"
          >
            <i
              class="fa-solid fa-plus border-2 text-orange border-blue p-3 text-[26px] rounded-full mr-3"
            ></i
            >Ajouter une formation
          </MyButton>
        </MyForm>
        <MyForm
          class="experiences border-2 border-blue px-6 pt-6 pb-8 rounded-[16px]"
        >
          <h3 class="text-blue text-3xl">Expérience professionnelle</h3>
          <hr class="border-blue mt-2 mb-3" />
          <p>
            Commencez par décrire vos expériences professionnelles.
            Organisez-les de façon chronologique, de la plus récente aux plus
            anciennes.
          </p>
          <div class="displayedExperiences" v-if="experiences.length > 0">
            <div v-for="(experience, index) in experiences" :key="index">
              <hr class="border-blue mt-2 mb-3" />
              <div class="flex justify-between">
                <div>
                  <p class="text-blue">{{ experience.jobTitle }}</p>
                  <span
                    >{{ formatDate(experience.startDate) }} -
                    {{ formatDate(experience.endDate) }}</span
                  >
                </div>
                <div class="flex gap-5">
                  <MyButton
                    :without-background="true"
                    @click.prevent="editExperience(index)"
                    ><i class="fa-solid fa-pen text-orange"></i
                  ></MyButton>
                  <MyButton
                    :without-background="true"
                    @click.prevent="removeExperience(index)"
                    ><i class="fa-solid fa-trash text-orange"></i
                  ></MyButton>
                </div>
              </div>
              <hr class="border-blue mt-3" />
            </div>
          </div>
          <div
            v-if="isExperienceFormVisible || experiences.length === 0"
            class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4"
          >
            <MyInput
              class="md:col-span-1"
              label="Intitulé du poste"
              type="text"
              inputName="jobTitle"
              :inputValue="jobTitle"
              @update:value="jobTitle = $event"
              :required="true"
            />
            <div v-if="jobTitleError" class="error-message text-sm text-orange">
              {{ jobTitleError }}
            </div>
            <MyInput
              class="md:col-span-1"
              label="Employeur"
              type="text"
              inputName="employer"
              :inputValue="employer"
              @update:value="employer = $event"
              :required="true"
            />
            <MyInput
              class="md:col-span-1"
              label="Lieu du poste"
              type="text"
              inputName="cityExperience"
              :inputValue="cityExperience"
              @update:value="cityExperience = $event"
              :required="true"
            />
            <div
              v-if="cityExperienceError"
              class="error-message text-sm text-orange"
            >
              {{ cityExperienceError }}
            </div>
            <MyInput
              class="md:col-span-1"
              label="Type de contrat"
              type="text"
              inputName="contractTypeExperience"
              :inputValue="contractTypeExperience"
              @update:value="contractTypeExperience = $event"
              :required="false"
            />
            <MyInput
              class="md:col-span-1"
              label="Date de début"
              type="date"
              inputName="startDateExperience"
              :inputValue="startDateExperience"
              @update:value="startDateExperience = $event"
              :required="true"
            />
            <div
              v-if="startDateExperienceError"
              class="error-message text-sm text-orange"
            >
              {{ startDateExperienceError }}
            </div>
            <MyInput
              class="md:col-span-1"
              label="Date de fin"
              type="date"
              inputName="endDateExperience"
              :inputValue="endDateExperience"
              @update:value="endDateExperience = $event"
              :required="true"
            />
            <div
              v-if="endDateExperienceError"
              class="error-message text-sm text-orange"
            >
              {{ endDateExperienceError }}
            </div>
            <MyInput
              class="md:col-span-2"
              label="Description"
              type="textarea"
              inputName="descriptionExperience"
              :inputValue="descriptionExperience"
              @update:value="descriptionExperience = $event"
            />
            <div class="md:col-span-2 py-3 flex justify-between">
              <MyButton
                :without-background="true"
                v-if="isEditingExperience"
                @click.prevent="clearExperienceForm"
                class="bg-background text-orange border-2 border-orange py-3 px-6"
              >
                Supprimer
              </MyButton>
              <MyButton
                @click.prevent="
                  isEditingExperience
                    ? updateExperience()
                    : saveExperiencesData()
                "
              >
                Enregistrer
              </MyButton>
            </div>
          </div>
          <MyButton
            @click.prevent="addExperience"
            :without-background="true"
            class="text-blue text-left whitespace-nowrap mt-4"
          >
            <i
              class="fa-solid fa-plus border-2 text-orange border-blue p-3 text-[26px] rounded-full mr-3"
            ></i
            >Ajouter une expérience
          </MyButton>
        </MyForm>
        <MyForm
          class="skills border-2 border-blue px-6 pt-6 pb-8 rounded-[16px]"
        >
          <h3 class="text-blue text-3xl">Compétences</h3>
          <hr class="border-blue mt-2 mb-3 text-sm" />
          <p>
            Les compétences reflétant des qualités personnelles telles que la
            ponctualité peuvent être perçues positivement par les recruteurs,
            pensez donc à les mentionner.
          </p>
          <div class="displayedSkills" v-if="skills.length > 0">
            <div v-for="(skill, index) in skills" :key="index">
              <hr class="border-blue mt-2 mb-6" />
              <div class="flex justify-between">
                <div>
                  <p class="text-blue">{{ skill.name }}</p>
                </div>
                <div class="flex gap-5">
                  <MyButton
                    :without-background="true"
                    @click.prevent="editSkill(index)"
                    ><i class="fa-solid fa-pen text-orange"></i
                  ></MyButton>
                  <MyButton
                    :without-background="true"
                    @click.prevent="removeSkill(index)"
                    ><i class="fa-solid fa-trash text-orange"></i
                  ></MyButton>
                </div>
              </div>
              <hr class="border-blue mt-6" />
            </div>
          </div>

          <div
            v-if="isSkillFormVisible || skills.length === 0"
            class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4"
          >
            <MyInput
              class="md:col-span-2"
              label="Compétence"
              type="text"
              inputName="nameSkill"
              :inputValue="nameSkill"
              @update:value="nameSkill = $event"
            />
            <div class="md:col-span-2 py-3 flex justify-between">
              <MyButton
                :without-background="true"
                v-if="isEditingSkill"
                @click.prevent="clearSkillForm"
                class="bg-background text-orange border-2 border-orange py-3 px-6"
              >
                Supprimer
              </MyButton>
              <MyButton
                @click.prevent="
                  isEditingSkill ? updateSkill() : saveSkillsData()
                "
              >
                Enregistrer
              </MyButton>
            </div>
          </div>
          <MyButton
            :without-background="true"
            class="text-blue text-left whitespace-nowrap mt-4"
            @click.prevent="addSkill"
          >
            <i
              class="fa-solid fa-plus border-2 text-orange border-blue p-3 text-[26px] rounded-full mr-3"
            ></i>
            Ajouter une compétence</MyButton
          >
        </MyForm>
        <MyForm
          class="languages border-2 border-blue px-6 pt-6 pb-8 rounded-[16px]"
        >
          <h3 class="text-blue text-3xl">Langues</h3>
          <hr class="border-blue mt-2 mb-3" />
          <p>
            N'oubliez pas de mentionner les langues que vous parlez couramment
            dans votre CV. Cela peut aider les recruteurs à évaluer votre
            capacité à interagir avec des clients multilingues.
          </p>
          <div class="displayedLanguages" v-if="languages.length > 0">
            <div v-for="(language, index) in languages" :key="index">
              <hr class="border-blue mt-2 mb-6" />
              <div class="flex justify-between">
                <div class="text-blue">
                  <p>{{ language.name }}</p>
                </div>
                <div class="flex gap-5">
                  <MyButton
                    :without-background="true"
                    @click.prevent="editLanguage(index)"
                    ><i class="fa-solid fa-pen text-orange"></i
                  ></MyButton>
                  <MyButton
                    :without-background="true"
                    @click.prevent="removeLanguage(index)"
                    ><i class="fa-solid fa-trash text-orange"></i
                  ></MyButton>
                </div>
              </div>
              <hr class="border-blue mt-6" />
            </div>
          </div>
          <div
            class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4"
            v-if="isLanguageFormVisible || languages.length === 0"
          >
            <MyInput
              class="md:col-span-2"
              label="Langue"
              type="text"
              inputName="nameLanguage"
              :inputValue="nameLanguage"
              @update:value="nameLanguage = $event"
            />
            <div class="md:col-span-2 py-3 flex justify-between">
              <MyButton
                :without-background="true"
                v-if="isEditingLanguage"
                @click.prevent="clearLanguageForm"
                class="bg-background text-orange border-2 border-orange py-3 px-6"
              >
                Supprimer
              </MyButton>
              <MyButton
                @click.prevent="
                  isEditingLanguage ? updateLanguage() : saveLanguagesData()
                "
              >
                Enregistrer
              </MyButton>
            </div>
          </div>
          <MyButton
            :without-background="true"
            class="text-blue text-left whitespace-nowrap mt-4"
            @click.prevent="addLanguage"
            ><i
              class="fa-solid fa-plus border-2 text-orange border-blue p-3 text-[26px] rounded-full mr-3"
            ></i
            >Ajouter une langue</MyButton
          >
        </MyForm>
        <MyForm
          class="socialMedias border-2 border-blue px-6 pt-6 pb-8 rounded-[16px]"
        >
          <h3 class="text-blue text-3xl">Réseaux sociaux</h3>
          <hr class="border-blue mt-2 mb-3" />
          <p>
            Pensez à inclure des liens vers vos profils de réseaux sociaux si
            cela est pertinent pour le poste que vous visez et que vos profils
            reflètent une image professionnelle.
          </p>
          <div class="diplayedSocialMedias" v-if="socialMedias.length > 0">
            <div v-for="(socialMedia, index) in socialMedias" :key="index">
              <hr class="border-blue mt-2 mb-6" />
              <div class="flex justify-between">
                <div class="text-blue">
                  <p>{{ socialMedia.name }}</p>
                </div>
                <div class="flex gap-5">
                  <MyButton
                    :without-background="true"
                    @click.prevent="editSocialMedia(index)"
                    ><i class="fa-solid fa-pen text-orange"></i
                  ></MyButton>
                  <MyButton
                    :without-background="true"
                    @click.prevent="removeSocialMedia(index)"
                    ><i class="fa-solid fa-trash text-orange"></i
                  ></MyButton>
                </div>
              </div>
              <hr class="border-blue mt-6" />
            </div>
          </div>
          <div
            v-if="isSocialMediaFormVisible || socialMedias.length === 0"
            class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4"
          >
            <MyInput
              class="md:col-span-1"
              label="Réseau social"
              type="text"
              inputName="nameSocialMedia"
              :inputValue="nameSocialMedia"
              @update:value="nameSocialMedia = $event"
            />
            <MyInput
              class="md:col-span-1"
              label="Pseudo"
              type="text"
              inputName="pseudoSocialMedia"
              :inputValue="pseudoSocialMedia"
              @update:value="pseudoSocialMedia = $event"
            />
            <div class="md:col-span-2 py-3 flex justify-between">
              <MyButton
                :without-background="true"
                v-if="isEditingSocialMedia"
                @click.prevent="clearSocialMediaForm"
                class="bg-background text-orange border-2 border-orange py-3 px-6"
              >
                Supprimer
              </MyButton>
              <MyButton
                @click.prevent="
                  isEditingSocialMedia
                    ? updateSocialMedia()
                    : saveSocialMediasData()
                "
              >
                Enregistrer
              </MyButton>
            </div>
          </div>
          <MyButton
            :without-background="true"
            class="text-blue text-left whitespace-nowrap mt-4"
            @click.prevent="addSocialMedia"
            ><i
              class="fa-solid fa-plus border-2 text-orange border-blue p-3 text-[26px] rounded-full mr-3"
            ></i
            >Ajouter une langue</MyButton
          >
        </MyForm>
      </div>
      <div class="preview md:w-1/2">
        <TemplateCV
          :name="selectedCVTemplate.name"
          :formations="formations"
          :experiences="experiences"
          :skills="skills"
          :languages="languages"
          :socialMedias="socialMedias"
          :dateOfBirth="dateOfBirth"
          :phoneNumber="phoneNumber"
          :postalAddress="postalAddress"
          :title="title"
          :description="descriptionProfil"
          :firstname="firstname"
          :lastname="lastname"
          :mailAddress="mailAddress"
          :drivingLicence="drivingLicence"
          :city="city"
          :zipCode="zipCode"
          :imageFromForm="imageFromForm"
          :textColor="selectedCVTemplate.textColor"
          :bgColor="selectedCVTemplate.bgColor"
          :titleColor="selectedCVTemplate.titleColor"
          :textFont="selectedCVTemplate.textFont"
        ></TemplateCV>
      </div>
    </div>
    <div v-if="currentStep === 'telecharger'">
      <TemplateCV
        ref="cvComponent"
        :name="selectedCVTemplate.name"
        :formations="formations"
        :experiences="experiences"
        :skills="skills"
        :languages="languages"
        :socialMedias="socialMedias"
        :dateOfBirth="dateOfBirth"
        :phoneNumber="phoneNumber"
        :postalAddress="postalAddress"
        :title="title"
        :description="descriptionProfil"
        :firstname="firstname"
        :lastname="lastname"
        :mailAddress="mailAddress"
        :drivingLicence="drivingLicence"
        :city="city"
        :zipCode="zipCode"
        :imageFromForm="imageFromForm"
        :textColor="selectedCVTemplate.textColor"
        :bgColor="selectedCVTemplate.bgColor"
        :titleColor="selectedCVTemplate.titleColor"
        :textFont="selectedCVTemplate.textFont"
      ></TemplateCV>
      <MyButton @click.prevent="downloadPDF">Télécharger en PDF</MyButton>
    </div>
    <div
      class="flex flex-col md:flex-row md:justify-center items-center gap-5 mt-8"
    >
      <MyButton
        :withoutBackground="true"
        v-if="currentStep !== 'choix-template'"
        @click="previousStep"
        class="text-blue"
      >
        <i class="fa-solid fa-chevron-left mr-3"></i> Étape précédente
      </MyButton>
      <MyButton
        v-if="currentStep !== 'telecharger'"
        @click="nextStep"
        class="flex items-center gap-3 text-center"
      >
        Étape suivante <i class="fa-solid fa-chevron-right"></i>
      </MyButton>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { useCVStore } from "../stores/cv";
import TemplateCV from "../components/TemplateCV";
import MyForm from "../components/form/MyForm.vue";
import MyInput from "../components/form/MyInput.vue";
import MyButton from "../components/MyButton";
import cookies from "vue-cookies";
import DOMPurify from "dompurify";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
import { parseISO, isBefore, subYears } from "date-fns"; // Importez les fonctions nécessaires

import cryptoJS from "crypto-js";
const encryptionKey = "secretkey";

export default {
  components: {
    TemplateCV,
    MyForm,
    MyInput,
    MyButton,
  },
  data() {
    return {
      modelsCV: [], // Tableau pour stocker les modèles de CV récupérés
      currentPage: 0,
      itemsPerPage: 3,
      selectedCV: {
        name: "",
        formations: [],
        experiences: [],
        languages: [],
        skills: [],
        socialMedias: [],
        profil: [],
      }, // Modèle de CV sélectionné par l'utilisateur
      selectedTemplateName: "",
      capturedImages: {},
      imagesCaptured: false, // Initialize as false

      formations: [],
      formationsDataSaved: false,
      editingFormationIndex: -1,
      isEditingFormation: false,
      isFormVisible: false,
      experiences: [],
      isExperienceFormVisible: false,
      isEditingExperience: false,
      editingExperienceIndex: -1,
      skills: [],
      isSkillFormVisible: false,
      isEditingSkill: false,
      editingSkillIndex: -1,
      languages: [],
      isLanguageFormVisible: false,
      isEditingLanguage: false,
      editingLanguageIndex: -1,
      socialMedias: [],
      isSocialMediaFormVisible: false,
      isEditingSocialMedia: false,
      editingSocialMediaIndex: -1,
      currentStep: "choix-template", // Étape actuelle du processus
      phoneNumber: "",
      postalAddress: "",
      dateOfBirth: "",
      title: "",
      descriptionProfil: "",
      image: "",
      firstname: "",
      lastname: "",
      mailAddress: "",
      drivingLicence: "",
      city: "",
      zipCode: "",
      degree: "",
      nameSchool: "",
      locationSchool: "",
      startDateFormation: "",
      endDateFormation: "",
      descriptionFormation: "",
      jobTitle: "",
      employer: "",
      cityExperience: "",
      startDateExperience: "",
      endDateExperience: "",
      descriptionExperience: "",
      contractTypeExperience: "",
      nameSkill: "",
      nameLanguage: "",
      nameSocialMedia: "",
      pseudoSocialMedia: "",
      bgColor: "",
      imageFromForm: "",
      firstnameError: "",
      lastnameError: "",
      mailAddressError: "",
      phoneNumberError: "",
      postalAddressError: "",
      zipCodeError: "",
      titleError: "",
      descriptionProfilError: "",
      dateOfBirthError: "",
      degreeError: "",
      locationSchoolError: "",
      nameSchoolError: "",
      startDateFormationError: "",
      endDateFormationError: "",
      jobTitleError: "",
      cityExperienceError: "",
      startDateExperienceError: "",
      endDateExperienceError: "",
    };
  },
  created() {
    this.adjustItemsPerPage();
    window.addEventListener('resize', this.adjustItemsPerPage);
    // Récupérez le nom de la template sélectionnée depuis les cookies
    const selectedTemplate = cookies.get("selectedTemplate");
    if (selectedTemplate) {
      this.selectedTemplateName = selectedTemplate;
    }
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.adjustItemsPerPage);
  },
  mounted() {
    this.getModelsCV(); // Appel à la fonction pour récupérer les modèles de CV lors du montage du composant
    this.loadFormationsFromCookies();
    this.loadExperiencesFromCookies();
    this.loadSkillsFromCookies();
    this.loadLanguagesFromCookies();
    this.loadSocialMediasFromCookies();
    this.loadInfosPersoFromCookies();
  },
  setup() {
    const cvStore = useCVStore(); // Utilisation du store CV

    return {
      cvStore,
    };
  },
  methods: {
    async getModelsCV() {
      try {
        const response = await axios.get("/api/modeles-de-cv");
        this.modelsCV = response.data;

        for (const cv of this.modelsCV) {
          await this.$nextTick(); // Attendre que les éléments soient rendus
          console.log("Capturing image for CV:", cv);
          const capturedImage = await this.captureTemplateCV(cv);
          this.capturedImages[cv.id] = capturedImage;
          this.cvStore.setCapturedImage(cv.id, capturedImage); // Stockez l'image dans le store Pinia
          console.log("Image captured for CV:", cv);
        }
      } catch (error) {
        console.error("Error fetching models:", error);
      }
    },
    async captureTemplateCV(cv) {
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d");

      console.log("Starting captureTemplateCV for CV:", cv);

      // Dynamically select the template element for each CV
      const templateCvElement = document.querySelector(`#template-${cv.id}`);
      console.log("Template element:", templateCvElement);

      if (!templateCvElement) {
        console.error("Template element not found");
        return;
      }

      const canvasImage = await html2canvas(templateCvElement);

      canvas.width = canvasImage.width;
      canvas.height = canvasImage.height;
      context.drawImage(canvasImage, 0, 0);

      const imageData = canvas.toDataURL("image/png");
      console.log("Image captured:", imageData);

      return imageData;
    },
    async captureImagesForVisibleCvs() {
  for (const cv of this.visibleCvs) {
    if (!this.capturedImages[cv.id]) {
      await this.$nextTick(); // Wait for DOM update
      const capturedImage = await this.captureTemplateCV(cv);
      this.capturedImages[cv.id] = capturedImage;
      this.cvStore.setCapturedImage(cv.id, capturedImage);
    }
  }
},

    allTemplatesCaptured() {
      return this.modelsCV.every(
        (template) => this.capturedImages[template.id]
      );
    },

    changeStep(step) {
      // Fonction pour changer l'étape actuelle
      this.currentStep = step;
    },
    goToPrevious() {
    if (this.currentPage > 0) {
      this.currentPage--;
      this.captureImagesForVisibleCvs(); // Capture images for visible templates
    }
  },
  goToNext() {
    if (this.currentPage < this.totalPages - 1) {
      this.currentPage++;
      console.log("Going to next page");
      this.captureImagesForVisibleCvs(); // Capture images for visible templates
    }
  },
    selectCV(cv) {
      // Fonction pour sélectionner un modèle de CV
      this.selectedCV.name = cv.name;
      this.selectedCV.formations = [];
      this.selectedCV.experiences = [];
      this.selectedCV.languages = [];
      this.selectedCV.skills = [];
      this.selectedCV.socialMedias = [];
      this.selectedCV.profil = [];
      this.imageFromForm = "";
      this.cvStore.reset(); // Réinitialisation des données du store CV
      this.cvStore.setSelectedTemplate(cv); // Définition du modèle de CV sélectionné dans le store

      this.currentStep = "infos-personnelles"; // Passage à l'étape suivante
    },
    handleImageChange(imageUrl) {
      this.imageFromForm = imageUrl; // Mettez à jour l'état Pinia
      this.saveImageToCookies(imageUrl); // Mettez à jour les cookies
    },

    saveImageToCookies(image) {
      cookies.set("imageFromForm", image);
    },
    sanitizeAndEscape(text) {
      // Utilisez DOMPurify pour nettoyer les données
      const sanitizedText = DOMPurify.sanitize(text);
      // Échappez les caractères spéciaux HTML pour éviter les attaques XSS
      const escapedText = this.escapeHtml(sanitizedText);
      return escapedText;
    },
    escapeHtml(text) {
      // Fonction d'échappement des caractères spéciaux HTML
      return text.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    },
    validateInfosPersoData() {
      this.titleError = this.title ? "" : "Le titre est requis.";
      this.descriptionProfilError = this.descriptionProfil
        ? ""
        : "La description est requise.";
      this.firstnameError = this.firstname ? "" : "Le prénom est requis.";
      this.lastnameError = this.lastname ? "" : "Le nom est requis.";
      this.mailAddressError = this.validateEmail(this.mailAddress)
        ? ""
        : "Adresse e-mail invalide.";
      this.phoneNumberError = this.validatePhoneNumber(this.phoneNumber)
        ? ""
        : "Numéro de téléphone invalide.";
      this.postalAddressError = this.postalAddress
        ? ""
        : "L'adresse postale est requise.";
      this.zipCodeError = this.validateZipCode(this.zipCode)
        ? ""
        : "Code postal invalide.";
      this.dateOfBirthError = this.validateDateOfBirth(this.dateOfBirth)
        ? ""
        : "Vous devez avoir plus de 16 ans.";

      // Retourne vrai si toutes les validations sont passées, sinon retourne faux
      return (
        !this.titleError &&
        !this.descriptionProfilError &&
        !this.firstnameError &&
        !this.lastnameError &&
        !this.mailAddressError &&
        !this.phoneNumberError &&
        !this.postalAddressError &&
        !this.dateOfBirthError &&
        !this.zipCodeError
      );
    },
    validateDateOfBirth(dateOfBirth) {
      // Validez si la personne a plus de 16 ans
      const birthDate = parseISO(dateOfBirth);
      const minAgeDate = subYears(new Date(), 16); // La date d'il y a 16 ans
      return isBefore(birthDate, minAgeDate); // Si la date d'anniversaire est avant la date d'il y a 16 ans
    },
    // Méthode pour valider l'email
    validateEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    },
    // Méthode pour valider le numéro de téléphone
    validatePhoneNumber(phoneNumber) {
      // Implémentez votre propre logique de validation pour le numéro de téléphone
      return /^[0-9]{10}$/.test(phoneNumber);
    },
    // Méthode pour valider le code postal
    validateZipCode(zipCode) {
      // Implémentez votre propre logique de validation pour le code postal
      return /^[0-9]{5}$/.test(zipCode);
    },
    formatDate(date) {
      const options = { year: "numeric", month: "long" };
      return new Date(date).toLocaleDateString(undefined, options);
    },
    // formatMonthYear(date) {
    //   const options = { month: "2-digit", year: "numeric" };
    //   return new Intl.DateTimeFormat("fr-FR", options).format(new Date(date));
    // },
    validateFormationData() {
      this.degreeError = this.degree ? "" : "Le champ est requis.";
      this.nameSchoolError = this.nameSchool ? "" : "Le champ est requis.";
      this.locationSchoolError = this.locationSchool
        ? ""
        : "Le champ est requis.";

      // Validation de la date de début
      this.startDateFormationError = !this.startDateFormation
        ? "Le champ est requis."
        : !this.isValidDateFormat(this.startDateFormation)
        ? "Le format de la date est invalide."
        : "";

      // Validation de la date de fin
      this.endDateFormationError = !this.endDateFormation
        ? "Le champ est requis."
        : !this.isValidDateFormat(this.endDateFormation)
        ? "Le format de la date est invalide."
        : this.isDateValid(this.startDateFormation, this.endDateFormation)
        ? "La date de fin doit être supérieure à la date de début."
        : "";

      // Vérifiez toutes les erreurs et retournez vrai si toutes les validations sont passées, sinon retournez faux
      return (
        !this.degreeError &&
        !this.nameSchoolError &&
        !this.locationSchoolError &&
        !this.startDateFormationError &&
        !this.endDateFormationError
      );
    },
    validateExperienceData() {
      this.jobTitleError = this.jobTitle
        ? ""
        : "Le champ 'Intitulé du poste' est requis.";
      this.cityExperienceError = this.cityExperience
        ? ""
        : "Le champ 'Lieu du poste' est requis.";

      // Validation de la date de début
      this.startDateExperienceError = !this.startDateExperience
        ? "Le champ 'Date de début' est requis."
        : !this.isValidDateFormat(this.startDateExperience)
        ? "Le format de la date est invalide."
        : "";

      // Validation de la date de fin
      this.endDateExperienceError = !this.endDateExperience
        ? "Le champ 'Date de fin' est requis."
        : !this.isValidDateFormat(this.endDateExperience)
        ? "Le format de la date est invalide."
        : this.isDateValid(this.startDateExperience, this.endDateExperience)
        ? "La date de fin doit être supérieure à la date de début."
        : "";

      // Vérifiez toutes les erreurs et retournez vrai si toutes les validations sont passées, sinon retournez faux
      return (
        !this.jobTitleError &&
        !this.cityExperienceError &&
        !this.startDateExperienceError &&
        !this.endDateExperienceError
      );
    },
    isDateValid(startDate, endDate) {
      const startDateObj = new Date(startDate);
      const endDateObj = new Date(endDate);
      return startDateObj >= endDateObj;
    },
    isValidDateFormat(date) {
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      return regex.test(date);
    },
    saveInfosPersoData() {
      if (!this.validateInfosPersoData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
      const profil = {
        imageFromForm: this.sanitizeAndEscape(this.imageFromForm),
        phoneNumber: this.sanitizeAndEscape(this.phoneNumber),
        postalAddress: this.sanitizeAndEscape(this.postalAddress),
        title: this.sanitizeAndEscape(this.title),
        descriptionProfil: this.sanitizeAndEscape(this.descriptionProfil),
        firstname: this.sanitizeAndEscape(this.firstname),
        lastname: this.sanitizeAndEscape(this.lastname),
        mailAddress: this.sanitizeAndEscape(this.mailAddress),
        drivingLicence: this.sanitizeAndEscape(this.drivingLicence),
        city: this.sanitizeAndEscape(this.city),
        zipCode: this.sanitizeAndEscape(this.zipCode),
        dateOfBirth: this.sanitizeAndEscape(this.dateOfBirth),
      };

      console.log("profil:", profil);
      if (this.selectedCV && this.selectedCV.name) {
        // Vérification de la sélection d'un modèle de CV
        this.cvStore.setProfil(profil); // Définition des profils dans le store
      }

      const encryptedProfil = cryptoJS.AES.encrypt(
        JSON.stringify(profil),
        encryptionKey
      ).toString();

      cookies.set(
        "personalData",
        encryptedProfil,
        "1d",
        null,
        null,
        true,
        "Strict"
      );
      console.log("Personal data saved to cookies:", encryptedProfil);
    },
    loadInfosPersoFromCookies() {
      try {
        const encryptedProfil = cookies.get("personalData");

        if (encryptedProfil) {
          const decryptedProfilBytes = cryptoJS.AES.decrypt(
            encryptedProfil,
            encryptionKey
          );

          if (decryptedProfilBytes.sigBytes === 0) {
            console.error("Error decrypting data.");
            return;
          }

          const decryptedProfil = JSON.parse(
            decryptedProfilBytes.toString(cryptoJS.enc.Utf8)
          );

          this.imageFromForm = decryptedProfil.imageFromForm;
          this.phoneNumber = decryptedProfil.phoneNumber;
          this.postalAddress = decryptedProfil.postalAddress;
          this.title = decryptedProfil.title;
          this.descriptionProfil = decryptedProfil.descriptionProfil;
          this.firstname = decryptedProfil.firstname;
          this.lastname = decryptedProfil.lastname;
          this.mailAddress = decryptedProfil.mailAddress;
          this.drivingLicence = decryptedProfil.drivingLicence;
          this.city = decryptedProfil.city;
          this.zipCode = decryptedProfil.zipCode;
          this.dateOfBirth = decryptedProfil.dateOfBirth;

          console.log("Personal data loaded from cookies:", decryptedProfil);
        }
      } catch (error) {
        console.error("Error while decrypting/parsing data:", error);
      }
    },
    saveFormationsData() {
      if (!this.validateFormationData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }

      const newFormation = {
        degree: this.sanitizeAndEscape(this.degree),
        nameSchool: this.sanitizeAndEscape(this.nameSchool),
        locationSchool: this.sanitizeAndEscape(this.locationSchool),
        startDate: this.startDateFormation,
        endDate: this.endDateFormation,
        description: this.sanitizeAndEscape(this.descriptionFormation),
      };

      if (this.isEditingFormation && this.editingFormationIndex >= 0) {
        this.formations[this.editingFormationIndex] = newFormation;
      } else {
        this.formations.push(newFormation);
      }
      this.clearFormationForm();
      this.isFormVisible = false;
      this.saveFormationsToCookies();
    },
    saveFormationsToCookies() {
      // crypter les stocker les data dans cookies
      const encryptedFormations = cryptoJS.AES.encrypt(
        JSON.stringify(this.formations),
        encryptionKey
      ).toString();

      cookies.set(
        "formationsData",
        encryptedFormations,
        "1d",
        null,
        null,
        true,
        "Strict"
      );
      console.log("Formations data loaded from cookies:", encryptedFormations);
    },
    loadFormationsFromCookies() {
      try {
        const encryptedFormations = cookies.get("formationsData");
        if (encryptedFormations) {
          const decryptedFormations = cryptoJS.AES.decrypt(
            encryptedFormations,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.formations = JSON.parse(decryptedFormations);
          console.log(
            "Formations data loaded from cookies:",
            decryptedFormations
          );
        }
      } catch (error) {
        console.error("Error while decrypting/parsing formations data:", error);
      }
    },
    addFormation() {
      this.isFormVisible = true;
      if (this.isEditingFormation && this.editingFormationIndex >= 0) {
        // Update the existing formation
        this.updateFormation();
      } else {
        // Add the new formation
        const newFormation = {
          degree: this.degree,
          nameSchool: this.nameSchool,
          locationSchool: this.locationSchool,
          startDate: this.startDateFormation,
          endDate: this.endDateFormation,
          description: this.descriptionFormation,
        };

        this.cvStore.addFormation([newFormation]);
        this.formationsDataSaved = false; // Reset the saved status
      }

      this.clearFormationForm(); // Clear the form fields
      this.isEditingFormation = false; // Reset the editing mode
    },
    editFormation(index) {
      this.isEditingFormation = true;
      this.editingFormationIndex = index;

      const formation = this.formations[index];
      this.degree = formation.degree;
      this.nameSchool = formation.nameSchool;
      this.locationSchool = formation.locationSchool;
      this.startDateFormation = formation.startDate;
      this.endDateFormation = formation.endDate;
      this.descriptionFormation = formation.description;

      this.isFormVisible = true;
    },
    updateFormation() {
      if (!this.validateFormationData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
      const updatedFormation = {
        degree: this.sanitizeAndEscape(this.degree),
        nameSchool: this.sanitizeAndEscape(this.nameSchool),
        locationSchool: this.sanitizeAndEscape(this.locationSchool),
        startDate: this.sanitizeAndEscape(this.startDateFormation),
        endDate: this.sanitizeAndEscape(this.endDateFormation),
        description: this.sanitizeAndEscape(this.descriptionFormation),
      };

      this.formations.splice(this.editingFormationIndex, 1, updatedFormation);

      this.clearFormationForm();
      this.isFormVisible = false;
      this.isEditingFormation = false;
      this.saveFormationsToCookies();
    },
    clearFormationForm() {
      // Reset the form fields and editingFormationIndex
      this.degree = "";
      this.nameSchool = "";
      this.locationSchool = "";
      this.startDateFormation = "";
      this.endDateFormation = "";
      this.descriptionFormation = "";
      this.editingFormationIndex = -1;
    },
    removeFormation(index) {
      this.formations.splice(index, 1);
      this.cvStore.removeFormation(index); // Suppression dans le store
      this.saveFormationsToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveExperiencesData() {
      // Code pour la sauvegarde des expériences (similaire à la sauvegarde des formations)
      const newExperience = {
        jobTitle: this.sanitizeAndEscape(this.jobTitle),
        employer: this.sanitizeAndEscape(this.employer),
        city: this.sanitizeAndEscape(this.cityExperience),
        startDate: this.sanitizeAndEscape(this.startDateExperience),
        endDate: this.sanitizeAndEscape(this.endDateExperience),
        description: this.sanitizeAndEscape(this.descriptionExperience),
        contractType: this.sanitizeAndEscape(this.contractTypeExperience),
      };

      if (this.isEditingExperience && this.editingExperienceIndex >= 0) {
        // Mettre à jour l'expérience existante
        this.experiences[this.editingExperienceIndex] = newExperience;
      } else {
        // Ajouter la nouvelle expérience
        this.experiences.push(newExperience);
      }

      this.clearExperienceForm();
      this.isExperienceFormVisible = false; // cacher le formulaire
      this.saveExperiencesToCookies(); // Appel de la fonction pour sauvegarder les expériences dans les cookies
    },
    saveExperiencesToCookies() {
      // Encrypt and store experiences data in cookies
      const encryptedExperiences = cryptoJS.AES.encrypt(
        JSON.stringify(this.experiences),
        encryptionKey
      ).toString();
      // 1 day expiration

      cookies.set(
        "experiencesData",
        encryptedExperiences,
        "1d",
        null,
        null,
        true,
        "Strict"
      );
      console.log("Experiences data saved to cookies:", encryptedExperiences);
    },
    loadExperiencesFromCookies() {
      try {
        const encryptedExperiences = cookies.get("experiencesData");
        if (encryptedExperiences) {
          const decryptedExperiences = cryptoJS.AES.decrypt(
            encryptedExperiences,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.experiences = JSON.parse(decryptedExperiences);
          console.log(
            "Experiences data loaded from cookies:",
            decryptedExperiences
          );
        }
      } catch (error) {
        console.error(
          "Error while decrypting/parsing experiences data:",
          error
        );
      }
    },
    // Méthode pour ajouter une expérience
    addExperience() {
      this.isExperienceFormVisible = true;
      if (this.isEditingExperience && this.editingExperienceIndex >= 0) {
        // Update the existing Experience
        this.updateExperience();
      } else {
        // Add the new Experience
        const newExperience = {
          jobTitle: this.jobTitle,
          employer: this.employer,
          city: this.cityExperience,
          startDate: this.startDateExperience,
          endDate: this.endDateExperience,
          description: this.descriptionExperience,
          contractType: this.contractTypeExperience,
        };

        this.cvStore.addExperience([newExperience]);
        this.experiencesDataSaved = false; // Reset the saved status
      }

      this.clearExperienceForm(); // Clear the form fields
      this.isEditingExperience = false; // Reset the editing mode
    },
    editExperience(index) {
      this.isEditingExperience = true;
      this.editingExperienceIndex = index;

      const experience = this.experiences[index];
      this.jobTitle = experience.jobTitle;
      this.employer = experience.employer;
      this.cityExperience = experience.city;
      this.startDateExperience = experience.startDate;
      this.endDateExperience = experience.endDate;
      this.descriptionExperience = experience.description;
      this.contractTypeExperience = experience.contractType;

      this.isExperienceFormVisible = true;
    },
    updateExperience() {
      if (!this.validateExperienceData()) {
        // Afficher un message d'erreur ou effectuer toute autre action en cas de données non valides
        return;
      }
      const updatedExperience = {
        jobTitle: this.jobTitle,
        employer: this.employer,
        city: this.cityExperience,
        startDate: this.startDateExperience,
        endDate: this.endDateExperience,
        description: this.descriptionExperience,
        contractType: this.contractTypeExperience,
      };

      this.experiences.splice(
        this.editingExperienceIndex,
        1,
        updatedExperience
      );

      this.clearExperienceForm();
      this.isExperienceFormVisible = false;
      this.isEditingExperience = false;
    },
    // Méthode pour réinitialiser le formulaire d'expérience
    clearExperienceForm() {
      this.jobTitle = "";
      this.employer = "";
      this.cityExperience = "";
      this.startDateExperience = "";
      this.endDateExperience = "";
      this.descriptionExperience = "";
      this.contractTypeExperience = "";
      this.editingExperienceIndex = -1;
    },
    removeExperience(index) {
      this.experiences.splice(index, 1);
      this.cvStore.removeExperience(index); // Suppression dans le store
      this.saveExperiencesToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveSkillsData() {
      const newSkill = {
        name: this.sanitizeAndEscape(this.nameSkill),
      };

      if (this.isEditingSkill && this.editingSkillIndex >= 0) {
        this.skills[this.editingSkillIndex] = newSkill;
      } else {
        this.skills.push(newSkill);
      }

      this.clearSkillForm();
      this.isSkillFormVisible = false;
      this.saveSkillsToCookies();
    },
    saveSkillsToCookies() {
      // Encrypt and store Skills data in cookies
      const encryptedSkills = cryptoJS.AES.encrypt(
        JSON.stringify(this.skills),
        encryptionKey
      ).toString();
      // 1 day expiration

      cookies.set(
        "skillsData",
        encryptedSkills,
        "1d",
        null,
        null,
        true,
        "Strict"
      );
      console.log("Skills data saved to cookies:", encryptedSkills);
    },
    loadSkillsFromCookies() {
      try {
        const encryptedSkills = cookies.get("skillsData");
        if (encryptedSkills) {
          const decryptedSkills = cryptoJS.AES.decrypt(
            encryptedSkills,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.skills = JSON.parse(decryptedSkills);
          console.log("Skills data loaded from cookies:", decryptedSkills);
        }
      } catch (error) {
        console.error("Error while decrypting/parsing skills data:", error);
      }
    },
    addSkill() {
      this.isSkillFormVisible = true;
      this.nameSkill = "";
      if (this.isEditingSkill && this.editingSkillIndex >= 0) {
        // Update the existing Skill
        this.updateSkill();
      } else {
        // Add the new Skill
        const newSkill = {
          name: this.sanitizeAndEscape(this.nameSkill),
        };

        this.cvStore.addSkill([newSkill]);
        this.skillsDataSaved = false; // Reset the saved status
      }

      this.clearSkillForm(); // Clear the form fields
      this.isEditingSkill = false; // Reset the editing mode
    },
    editSkill(index) {
      this.isEditingSkill = true;
      this.editingSkillIndex = index;

      const skill = this.skills[index];
      this.nameSkill = skill.name;

      this.isSkillFormVisible = true;
    },
    updateSkill() {
      const updatedSkill = {
        name: this.nameSkill,
      };

      this.skills.splice(this.editingSkillIndex, 1, updatedSkill);

      this.clearSkillForm();
      this.isSkillFormVisible = false;
      this.isEditingSkill = false;
      this.saveSkillsToCookies(); // Mettre à jour les cookies
    },
    clearSkillForm() {
      this.nameSkill = "";
      this.editingSkillIndex = -1;
    },
    removeSkill(index) {
      this.skills.splice(index, 1);
      this.cvStore.removeSkill(index); // Suppression dans le store
      this.saveSkillsToCookies(); // Mettre à jour les cookies
    },
    saveLanguagesData() {
      const newLanguage = {
        name: this.sanitizeAndEscape(this.nameLanguage),
      };

      if (this.isEditingLanguage && this.editingLanguageIndex >= 0) {
        this.languages[this.editingLanguageIndex] = newLanguage;
      } else {
        this.languages.push(newLanguage);
      }

      this.clearLanguageForm();
      this.isLanguageFormVisible = false;
      this.saveLanguagesToCookies(); // Save data to cookies
    },
    saveLanguagesToCookies() {
      // Encrypt and store Languages data in cookies
      const encryptedLanguages = cryptoJS.AES.encrypt(
        JSON.stringify(this.languages),
        encryptionKey
      ).toString();
      // 1 day expiration

      cookies.set(
        "languagesData",
        encryptedLanguages,
        "1d",
        null,
        null,
        true,
        "Strict"
      );
      console.log("Languages data saved to cookies:", encryptedLanguages);
    },
    loadLanguagesFromCookies() {
      try {
        const encryptedLanguages = cookies.get("languagesData");
        if (encryptedLanguages) {
          const decryptedLanguages = cryptoJS.AES.decrypt(
            encryptedLanguages,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.languages = JSON.parse(decryptedLanguages);
          console.log(
            "Languages data loaded from cookies:",
            decryptedLanguages
          );
        }
      } catch (error) {
        console.error("Error while decrypting/parsing Languages data:", error);
      }
    },
    addLanguage() {
      this.isLanguageFormVisible = true;
      this.nameLanguage = "";
      if (this.isEditingLanguage && this.editingLanguageIndex >= 0) {
        // Update the existing Language
        this.updateLanguage();
      } else {
        // Add the new Language
        const newLanguage = {
          name: this.sanitizeAndEscape(this.nameLanguage),
        };

        this.cvStore.addLanguage([newLanguage]);
        this.languagesDataSaved = false; // Reset the saved status
      }

      this.clearLanguageForm(); // Clear the form fields
      this.isEditingLanguage = false; // Reset the editing mode
    },
    editLanguage(index) {
      this.isEditingLanguage = true;
      this.editingLanguageIndex = index;

      const language = this.languages[index];
      this.nameLanguage = language.name;

      this.isLanguageFormVisible = true;
    },
    updateLanguage() {
      const updatedLanguage = {
        name: this.sanitizeAndEscape(this.nameLanguage),
      };

      this.languages.splice(this.editingLanguageIndex, 1, updatedLanguage);

      this.clearLanguageForm();
      this.isLanguageFormVisible = false;
      this.isEditingLanguage = false;
      this.saveLanguagesToCookies();
    },
    clearLanguageForm() {
      this.nameLanguage = "";
      this.editingLanguageIndex = -1;
    },
    removeLanguage(index) {
      this.languages.splice(index, 1);
      this.cvStore.removeLanguage(index); // Suppression dans le store
      this.saveLanguagesToCookies(); // Mettre à jour les cookies si nécessaire
    },
    saveSocialMediasData() {
      const newSocialMedia = {
        name: this.sanitizeAndEscape(this.nameSocialMedia),
        pseudo: this.sanitizeAndEscape(this.pseudoSocialMedia),
      };

      if (this.isEditingSocialMedia && this.editingSocialMediaIndex >= 0) {
        this.socialMedias[this.editingSocialMediaIndex] = newSocialMedia;
      } else {
        this.socialMedias.push(newSocialMedia);
      }

      this.clearSocialMediaForm();
      this.isSocialMediaFormVisible = false;
      this.saveSocialMediasToCookies();
      // Save data to cookies
    },
    saveSocialMediasToCookies() {
      // crypter et stocker dans les cookies
      const encryptedSocialMedias = cryptoJS.AES.encrypt(
        JSON.stringify(this.socialMedias),
        encryptionKey
      ).toString();

      cookies.set(
        "socialMediasData",
        encryptedSocialMedias,
        "1d",
        null,
        null,
        true,
        "Strict"
      );
      console.log("SocialMedias data saved to cookies:", encryptedSocialMedias);
    },
    loadSocialMediasFromCookies() {
      try {
        const encryptedSocialMedias = cookies.get("socialMediasData");
        if (encryptedSocialMedias) {
          const decryptedSocialMedias = cryptoJS.AES.decrypt(
            encryptedSocialMedias,
            encryptionKey
          ).toString(cryptoJS.enc.Utf8);

          this.socialMedias = JSON.parse(decryptedSocialMedias);
          console.log(
            "SocialMedias data loaded from cookies:",
            decryptedSocialMedias
          );
        }
      } catch (error) {
        console.error(
          "Error while decrypting/parsing SocialMedias data:",
          error
        );
      }
    },
    addSocialMedia() {
      this.isSocialMediaFormVisible = true;
      this.nameSocialMedia = "";
      this.pseudoSocialMedia = "";
      if (this.isEditingSocialMedia && this.editingSocialMediaIndex >= 0) {
        // Update the existing SocialMedia
        this.updateSocialMedia();
      } else {
        // Add the new SocialMedia
        const newSocialMedia = {
          name: this.sanitizeAndEscape(this.nameSocialMedia),
          pseudo: this.sanitizeAndEscape(this.pseudoSocialMedia),
        };

        this.cvStore.addSocialMedia([newSocialMedia]);
        this.SocialMediasDataSaved = false; // Reset the saved status
      }

      this.clearSocialMediaForm(); // Clear the form fields
      this.isEditingSocialMedia = false; // Reset the editing mode
    },
    editSocialMedia(index) {
      this.isEditingSocialMedia = true;
      this.editingSocialMediaIndex = index;

      const socialMedia = this.socialMedias[index];
      this.nameSocialMedia = socialMedia.name;
      this.pseudoSocialMedia = socialMedia.pseudo;

      this.isSocialMediaFormVisible = true;
    },
    updateSocialMedia() {
      const updatedSocialMedia = {
        name: this.sanitizeAndEscape(this.nameSocialMedia),
        pseudo: this.sanitizeAndEscape(this.pseudoSocialMedia),
      };

      this.socialMedias.splice(
        this.editingSocialMediaIndex,
        1,
        updatedSocialMedia
      );

      this.clearSocialMediaForm();
      this.isSocialMediaFormVisible = false;
      this.isEditingSocialMedia = false;
      this.saveSocialMediasToCookies();
    },
    clearSocialMediaForm() {
      this.nameSocialMedia = "";
      this.pseudoSocialMedia = "";
      this.editingSocialMediaIndex = -1;
    },
    removeSocialMedia(index) {
      this.socialMedias.splice(index, 1);
      this.cvStore.removeSocialMedia(index); // Suppression dans le store
      this.saveSocialMediasToCookies(); // Mettre à jour les cookies si nécessaire
    },
    async downloadPDF() {
      // Récupérer la référence au composant CV
      const cvComponent = this.$refs.cvComponent;

      // Générer le contenu HTML du CV
      const cvContent = cvComponent.$el.outerHTML;

      // Convertir le contenu HTML en PDF
      const pdf = new jsPDF();
      const canvas = await html2canvas(cvComponent.$el);
      const imgData = canvas.toDataURL("image/png");
      pdf.addImage(imgData, "PNG", 10, 10, 190, 280);
      pdf.save("mon_cv.pdf");
    },
    previousStep() {
      // Méthode pour passer à l'étape précédente
      if (this.currentStep === "infos-personnelles") {
        this.currentStep = "choix-template";
      } else if (this.currentStep === "telecharger") {
        this.currentStep = "infos-personnelles";
      }
    },
    nextStep() {
      // Méthode pour passer à l'étape suivante
      if (this.currentStep === "choix-template") {
        this.currentStep = "infos-personnelles";
      } else if (this.currentStep === "infos-personnelles") {
        this.currentStep = "telecharger";
      }
    },
  },
  computed: {
    totalPages() {
      return Math.ceil(this.modelsCV.length / this.itemsPerPage);
    },
    visibleCvs() {
    const startIndex = this.currentPage * this.itemsPerPage;
    const endIndex = startIndex + this.itemsPerPage;
    const visibleCvs = this.modelsCV.slice(startIndex, endIndex).map(cv => ({
      ...cv,
      cvCaptured: this.capturedImages[cv.id], // Add captured status to each cv
    }));
    console.log("Visible CVs:", visibleCvs);
    return visibleCvs;
  },
    selectedCVTemplate() {
      // Calcul de la propriété "selectedCVTemplate"
      return this.cvStore.getSelectedTemplate; // Récupération du modèle de CV
    },
  },
};
</script>
<style>


progress-bar li.active {
  width: 100%;
  opacity: 1;
}
progress-bar li {
  opacity: 0;
}

</style>

<div class="preview hidden md:block md:w-1/2">
  <div class="">
<div class="preview-button">
<MyButton @click="openPreviewPopup">Voir la prévisualisation</MyButton>
</div>
<div
v-if="isPreviewPopupOpen"
class="popup-content"
>
<TemplateCV
    :useTemplateA4="false"
    :name="selectedCVTemplate.name"
    :formations="formations"
    :experiences="experiences"
    :skills="skills"
    :languages="languages"
    :socialMedias="socialMedias"
    :dateOfBirth="dateOfBirth"
    :phoneNumber="phoneNumber"
    :postalAddress="postalAddress"
    :title="title"
    :description="descriptionProfil"
    :firstname="firstname"
    :lastname="lastname"
    :mailAddress="mailAddress"
    :drivingLicence="drivingLicence"
    :city="city"
    :zipCode="zipCode"
    :imageFromForm="imageFromForm"
    :textColor="selectedCVTemplate.textColor"
    :bgColor="selectedCVTemplate.bgColor"
    :titleColor="selectedCVTemplate.titleColor"
    :textFont="selectedCVTemplate.textFont"
  ></TemplateCV>
<div class="popup-overlay" @click="closePreviewPopup">Fermer</div>
</div>
</div>
  <div class="" style="width: 100%; height: 100%; overflow: hidden;">
    <TemplateCV
    :useTemplateA4="false"
    :name="selectedCVTemplate.name"
    :formations="formations"
    :experiences="experiences"
    :skills="skills"
    :languages="languages"
    :socialMedias="socialMedias"
    :dateOfBirth="dateOfBirth"
    :phoneNumber="phoneNumber"
    :postalAddress="postalAddress"
    :title="title"
    :description="descriptionProfil"
    :firstname="firstname"
    :lastname="lastname"
    :mailAddress="mailAddress"
    :drivingLicence="drivingLicence"
    :city="city"
    :zipCode="zipCode"
    :imageFromForm="imageFromForm"
    :textColor="selectedCVTemplate.textColor"
    :bgColor="selectedCVTemplate.bgColor"
    :titleColor="selectedCVTemplate.titleColor"
    :textFont="selectedCVTemplate.textFont"
  ></TemplateCV>
  </div>
 
</div>