<template>
  <div v-if="saveFailed && url" class="m-auto md:w-2/3">
    <div class="alert">
      <span class="text-lg inline-block md:mr-3">
        <i class="fa fa-check" />
      </span>
      You can use this base64 URL instead of a saved one:
      <code v-text="url" class="font-bold break-words"></code>
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
