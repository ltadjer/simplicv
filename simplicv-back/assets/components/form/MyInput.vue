<template>
  <div class="field">
    <label class="block text-gray-600 text-sm mb-1" :for="inputId">{{ label }}</label>
    <template v-if="type === 'textarea'">
      <textarea
        :id="inputId"
        :name="inputName"
        :value="inputValue"
        @input="handleInput"
        :required="required"
        :placeholder="InputPlaceholder"
        class="bg-background text-blue placeholder-gray-500 border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200"
      ></textarea>
    </template>
    <template v-else-if="type === 'file'">
      <input
        :id="inputId"
        :type="type"
        :name="inputName"
        @change="handleFileChange"
        :required="required"
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
          class="bg-background text-blue placeholder-gray-500 border border-gray-300 rounded-lg py-1 px-3 focus:outline-none focus:border-blue focus:ring focus:ring-blue-200"
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
    }
  },
};
</script>

