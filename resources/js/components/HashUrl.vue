<template>
  <div v-if="saveSucceeded && url" class="col-md-12 text-center">
    <div class="alert alert-info">
      Permalink (24 hours):
      <a :href="url" target="_blank" v-text="url"></a>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    saveSucceeded() {
      return !this.$store.getters.saveFailed
    },
    url() {
      return this.$store.getters.hashUrl
    },
  },
}
</script>
