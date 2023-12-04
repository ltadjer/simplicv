<template>
  <div class="field m-0">
    <label v-if="type !== 'file'" class="block text-gray-600 text-md mb-1" :for="inputId">{{ label }}<span v-if="required" class="text-orange">*</span></label>
    <label v-else>
  <i
    class="fa-solid fa-camera text-orange text-6xl border-2 rounded-full p-12 cursor-pointer"
    @click="openFileInput"
  ></i>
</label>
    <template v-if="type === 'textarea'">
      <textarea
        rows="5"
        :id="inputId"
        :name="inputName"
        :value="inputValue"
        @input="handleInput"
        :required="required"
        :placeholder="InputPlaceholder"
        class="w-full border-blue text-sm bg-background placeholder-gray border-2 rounded-[12px] py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200"
      ></textarea>
    </template>
    <template v-else-if="type === 'file'">
      <input
        :id="inputId"
        :type="type"
        :name="inputName"
        @change="handleFileChange"
        :required="required"
        class="hidden"
        ref="fileInput"

      />
    </template>
    <template v-else>
        <input
          :id="inputId"
          :type="type"
          :name="inputName"
          :value="inputValue"
          @input="handleInput"
          :required="required"
          :placeholder="InputPlaceholder"
          class="w-full border-blue bg-background text-sm placeholder-gray border-2 border-gray-300 rounded-[12px] py-1 px-3 focus:outline-none focus:border-blue focus:ring focus:ring-blue-200"
        />
    </template>
  </div>
</template>

<script>

export default {
  props: {
    label: String,
    InputPlaceholder: String,
    type: {
      type: String,
      default: "text",
    },
    inputName: String,
    inputId: String,
    inputValue: [String, Number],
    required: Boolean,
  },
  
  methods: {
    handleInput(event) {
      this.$emit("update:value", event.target.value);
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        const imageUrl = URL.createObjectURL(file);
        this.$emit("update:value", imageUrl);
        this.$emit("changeImage", imageUrl);
      }
    },
    openFileInput() {
    const inputElement = this.$refs.fileInput;
    inputElement.click();
  },
  },
};
</script>

