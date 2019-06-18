<template>
  <div v-if="saveFailed && url" class="col-md-12 text-center">
    <div class="alert alert-info">
      You can use this base64 URL instead of a saved one:
      <code v-text="url"></code>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    saveFailed() {
      return this.$store.getters.saveFailed
    },
    url() {
      return this.$store.getters.base64Url
    },
  },
}
</script>
