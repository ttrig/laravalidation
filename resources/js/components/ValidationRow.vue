<template>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input
        type="text"
        placeholder="e.g. required|string"
        class="form-control"
        :class="ruleClassName"
        :name="ruleInputName"
        v-model="row.rule"
        @keyup="updateRow"
      >
      <div class="invalid-feedback">
        {{ ruleErrors.toString() }}
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text" v-text="valueInputName"></div>
        </div>
        <input
          autocomplete="off"
          type="text"
          placeholder="value to validate"
          class="form-control"
          :class="valueClassName"
          :name="valueInputName"
          :readonly="row.disabled"
          v-model="row.value"
          @keyup="updateRow"
        >
        <div class="input-group-append">
          <div class="input-group-text">
            <input
              type="checkbox"
              aria-label="Checkbox for disabling this value"
              :checked="!row.disabled"
              @change="toggleRow"
            >
          </div>
        </div>
        <div class="input-group-append">
          <button
            type="button"
            class="btn btn-sm btn-danger"
            @click="deleteRow"
          >
            <i class="fa fa-trash"></i>
          </button>
        </div>
        <!-- these feedback div's breaks rounded border on the input-group above :'( -->
        <div class="valid-feedback">
          Looks good!
        </div>
        <div class="invalid-feedback">
          {{ valueErrors.toString() }}
        </div>
        <div v-if="row.disabled" class="w-100 text-muted disabled-text">
          Disabled, will not be sent to validation.
        </div>
      </div>
      <hr class="d-sm-none">
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'row',
  ],
  computed: {
    errors() {
      return this.$store.getters.errors
    },
    ruleInputName() {
      return 'rule-' + this.row.id
    },
    valueInputName() {
      return 'value-' + this.row.id
    },
    ruleClassName() {
      if (!this.errors || this.row.disabled) {
        return ''
      }

      return this.ruleErrors.length
        ? 'is-invalid'
        : 'is-valid'
    },
    valueClassName() {
      if (this.ruleErrors.length || this.row.disabled) {
        return ''
      }

      return this.valueErrors.length
        ? 'is-invalid'
        : 'is-valid'
    },
    ruleErrors() {
      return _.get(this.errors, 'rule-' + this.row.id, [])
    },
    valueErrors() {
      return _.get(this.errors, 'value-' + this.row.id, [])
    },
  },
  methods: {
    deleteRow() {
      this.$store.commit('deleteRow', this.row.id)
      this.$store.dispatch('validate')
    },
    updateRow() {
      // TODO add some lazy keys stuff here
      this.$store.commit('updateRow', this.row)
      this.$store.dispatch('validate')
    },
    toggleRow() {
      this.$store.commit('toggleRow', this.row)
      this.$store.dispatch('validate')
    },
  },
}
</script>

<style scoped>
.disabled-text {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 80%;
}
</style>
