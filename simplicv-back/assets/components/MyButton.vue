<template>
  <button
    class="text-background rounded-full transition-transform transform hover:bg-orange hover:scale-105 active:scale-95"
    :class="{'bg-orange': !withoutBackground, 'py-3 px-6': !withoutBackground}"
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
