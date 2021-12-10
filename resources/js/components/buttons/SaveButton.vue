<template>
  <button
    type="button"
    class="btn"
    :class="disable ? 'bg-gray-300' : 'bg-gray-400'"
    :disabled="disable"
    @click="click"
  >
    <i v-if="saving" class="fa fa-fw fa-spin fa-spinner"></i>
    <i v-else class="fa fa-fw fa-save"></i>
    Save
  </button>
</template>

<script>
export default {
  computed: {
    saving() {
      return this.$store.state.saving
    },
    disable() {
      if (this.saving) {
        return true
      }
      return !this.$store.getters.count || this.$store.getters.savedDiff
    },
  },
  methods: {
    click() {
      this.$store.dispatch('save')
    },
  },
}
</script>
