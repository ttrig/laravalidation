<template>
  <div class="form-row">

    <div class="d-flex col-md-6 align-items-baseline">

      <button
        type="button"
        class="btn btn-sm btn-danger mr-1"
        title="Delete row"
        @click="deleteRow"
      >
        <i class="fa fa-fw fa-trash"></i>
      </button>

      <button
        type="button"
        class="btn btn-sm"
        :class="row.disabled ? 'btn-success' : 'btn-secondary'"
        :title="row.disabled ? 'Enable row' : 'Disable row'"
        @click="toggleRowDisabled"
      >
        <i class="fa fa-fw" :class="row.disabled ? 'fa-toggle-on' : 'fa-toggle-off'"></i>
      </button>

      <div class="form-group flex-grow-1 p-1">
        <input
          type="text"
          placeholder="e.g. required|string"
          class="form-control"
          :class="ruleClassName"
          :name="ruleInputName"
          :readonly="row.disabled"
          v-model="row.rule"
          @keyup="updateRow"
        >
        <div class="invalid-feedback">
          {{ ruleErrors.toString() }}
        </div>
        <div v-if="row.disabled" class="w-100 text-muted disabled-text">
          Row is disabled, it will not be sent to validation.
        </div>
      </div>

    </div>

    <div class="d-flex col-md-6 flex-row-reverse flex-md-row align-items-baseline">

      <div class="form-group flex-grow-1 p-1">

        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text" v-text="valueInputName"></div>
          </div>
          <input
            autocomplete="off"
            type="text"
            class="form-control"
            :class="valueClassName"
            :name="valueInputName"
            :readonly="row.disabled || ! row.send_value"
            :placeholder="row.value === null ? 'null' : 'value to validate'"
            v-model="row.value"
            @keyup="updateRow"
          >
        </div>

        <div v-if="! valueErrors.length" class="valid-feedback d-block">
          Looks good!
        </div>

        <div v-if="valueErrors.length" class="invalid-feedback d-block">
          {{ valueErrors.toString() }}
        </div>

        <div v-if="! row.disabled && ! row.send_value" class="w-100 text-muted disabled-text">
          Row will be validated but {{ valueInputName }} will not be sent.
        </div>

      </div>

        <button
          type="button"
          class="btn btn-sm ml-1 ml-md-0"
          :class="row.send_value ? 'btn-warning' : 'btn-warning'"
          :title="row.send_value ? 'Disable value' : 'Enable value'"
          @click="toggleRowSendValue"
        >
          <i class="fa fa-fw" :class="row.send_value ? 'fa-eye' : 'fa-eye-slash'"></i>
        </button>

        <button
          type="button"
          class="btn btn-sm btn-primary ml-md-1"
          title="Null"
          @click="nullRow"
        >
          <i class="fa fa-fw fa-eraser"></i>
        </button>


    </div>

    <hr class="d-md-none">
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
    toggleRowDisabled() {
      this.$store.commit('toggleRowDisabled', this.row)
      this.$store.dispatch('validate')
    },
    toggleRowSendValue() {
      this.$store.commit('toggleRowSendValue', this.row)
      this.$store.dispatch('validate')
    },
    nullRow(event) {
      this.$store.commit('nullRow', this.row)
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
