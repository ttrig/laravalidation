<template>
  <button
    type="button"
    class="btn btn-secondary"
    :disabled="disable"
    @click="save"
  >
    <span v-if="isSaving" class="spinner-border spinner-border-sm"
      role="status"
      aria-hidden="true"
    ></span>
    <i v-if="!isSaving" class="fa fa-save"></i> Save
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
