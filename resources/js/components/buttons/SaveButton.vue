<template>
  <button
    type="button"
    class="btn"
    :class="disable ? 'bg-gray-300' : 'bg-gray-400'"
    :disabled="disable"
    @click="save"
  >
    <i v-if="isSaving" class="fa fa-fw fa-spin fa-spinner"></i>
    <i v-else class="fa fa-fw fa-save"></i>
    Save
  </button>
</template>

<script>
export default {
  data() {
    return {
      isSaving: false
    }
  },
  props: ['count'],
  computed: {
    disable() {
      if (this.isSaving) {
        return true
      }
      return !this.count || this.$store.getters.savedDiff
    },
  },
  methods: {
    save() {
      this.isSaving = true

      if (!this.count || this.$store.getters.savedDiff) {
        return
      }

      let data = {
        json: JSON.stringify(this.$store.getters.rows)
      }

      axios.post('/save', data)
         .then(response => {
           this.$store.commit('setHashid', response.data)
           this.$store.commit('setSaveFailed', false)
         })
         .catch(error => {
           this.$store.commit('setSaveFailed', true)
         })
         .finally(() => {
           this.$store.commit('setSavedRows')
           this.isSaving = false
         })
    },
  },
}
</script>
