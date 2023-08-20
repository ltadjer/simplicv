<template>
  <div class="field">
    <label :for="inputId">{{ label }}</label>
    <template v-if="type === 'textarea'">
      <textarea
        :id="inputId"
        :name="inputName"
        :value="inputValue"
        @input="handleInput"
        :required="required"
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
        />
    </template>
  </div>
</template>

<script>

export default {
  name: "MyInput",
  props: {
    label: String,
    type: {
      type: String,
      default: "text",
    },
    inputName: String,
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

