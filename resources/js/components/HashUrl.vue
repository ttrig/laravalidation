<template>
  <div v-if="saveSucceeded && url" class="m-auto md:w-1/2">
    <div class="alert">
      <span class="text-lg inline-block md:mr-3">
        <i class="fa fa-check" />
      </span>
      <span class="inline-block">
        Permalink (24 hours):
        <a :href="url" target="_blank" class="font-bold" v-text="url"></a>
      </span>
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
