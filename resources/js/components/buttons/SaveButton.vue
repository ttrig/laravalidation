<template>
  <button
    type="button"
    class="btn"
    :class="disabled ? 'bg-gray-300' : 'bg-gray-400'"
    :disabled="disabled"
    @click="save"
  >
    <i v-if="isSaving" class="fa fa-fw fa-spin fa-spinner"></i>
    <i v-else class="fa fa-fw fa-save"></i>
    Save
  </button>

  <Teleport to="#url-container" v-if="! failed && permaLink">
    <Alert>
      Permalink (24 hours):
      <a :href="permaLink" target="_blank" class="font-bold" v-text="permaLink"></a>
    </Alert>
  </Teleport>

  <Teleport to="#url-container" v-if="failed && base64Url">
    <Alert>
      You can use this base64 URL instead of a saved one:
      <code v-text="base64Url" class="font-bold break-words"></code>
    </Alert>
  </Teleport>
</template>

<script>
import Alert from '@/components/Alert.vue'

export default {
  data: () => ({
    isSaving: false,
    failed: false,
    savedRows: [],
    savedHashid: null,
  }),
  components: {
    Alert,
  },
  created() {
    this.savedRows = this.$store.state.rows
  },
  computed: {
    disabled() {
      return this.isSaving
        || this.$store.state.rows.length < 1
        || this.savedRows == this.$store.state.rows
    },
    permaLink() {
      if (this.savedHashid) {
        return `${window.location.protocol}//${window.location.host}/${this.savedHashid}`
      }

      return null
    },
    base64Url() {
      if (this.$store.state.rows.length) {
        const json = JSON.stringify(this.$store.state.rows)
        return `${window.location.protocol}//${window.location.host}/` + btoa(json)
      }

      return null
    },
  },
  methods: {
    save() {
      let rowsToSave = this.$store.state.rows

      this.isSaving = true
      this.savedHashid = null

      axios.post('/api/save', { json: JSON.stringify(rowsToSave) })
        .then(response => {
          this.savedHashid = response.data
          this.failed = false
        })
        .catch(error => {
          this.failed = true
        })
        .finally(() => {
          this.savedRows = rowsToSave
          this.isSaving = false
        })
    },
  },
}
</script>
