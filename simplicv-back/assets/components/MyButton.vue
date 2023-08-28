<template>
  <button
    class="text-background rounded-full transition-transform transform hover:scale-105 active:scale-95"
    :class="{'bg-orange hover:bg-orange px-3.5 py-3 sm:px-6': !withoutBackground}"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    withoutBackground: Boolean
  }
}
</script>

<style scoped>
/* Your scoped styles here */
</style>
