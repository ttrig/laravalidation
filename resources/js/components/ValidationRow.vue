<template>
  <div class="flex flex-col md:flex-row text-sm mb-2">

    <div class="flex md:w-1/2 items-baseline">

      <button
        type="button"
        class="btn mr-1 bg-red-600"
        title="Delete row"
        @click="deleteRow"
      >
        <i class="fa fa-fw fa-trash"></i>
      </button>

      <button
        type="button"
        class="btn"
        :class="row.disabled ? 'bg-green-500' : 'bg-gray-500'"
        :title="row.disabled ? 'Enable row' : 'Disable row'"
        @click="toggleRowDisabled"
      >
        <i class="fa fa-fw" :class="row.disabled ? 'fa-toggle-on' : 'fa-toggle-off'"></i>
      </button>

      <div class="flex flex-col flex-grow p-1">

        <div class="relative w-full flex flex-wrap items-stretch mb-1">
          <input
            type="text"
            placeholder="e.g. required|string"
            class="px-3 py-3 text-gray-700 relative bg-white rounded shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10"
            :class="ruleClassName"
            :name="ruleInputName"
            :readonly="row.disabled"
            v-model="row.rule"
            @keyup="updateRow"
          >
          <span class="absolute h-full w-8 right-0 pr-3 py-3 z-10 leading-snug text-gray-400 rounded">
            <i v-if="ruleErrors.length" class="fas fa-exclamation-circle text-red-400"></i>
            <i v-else class="fas fa-check text-green-500"></i>
          </span>
        </div>

        <div class="text-red-400">
          {{ ruleErrors.toString() }}
        </div>

        <div v-if="row.disabled" class="text-gray-400">
          Row is disabled, it will not be sent to validation.
        </div>

      </div>

    </div>

    <div class="flex flex-row md:w-1/2 flex-row-reverse md:flex-row items-baseline">

      <div class="flex-grow p-1">

        <div class="relative w-full flex flex-wrap items-stretch mb-1">
          <span class="absolute h-full w-20 py-3 z-10 leading-snug text-gray-400 text-center bg-gray-100 rounded-l">
            <div class="input-group-text" v-text="valueInputName"></div>
          </span>
          <input
            autocomplete="off"
            type="text"
            class="relative w-full px-3 py-3 pl-24 text-gray-700 rounded shadow outline-none focus:outline-none focus:shadow-outline"
            :class="valueClassName"
            :name="valueInputName"
            :readonly="row.disabled || ! row.send_value"
            :placeholder="row.value === null ? 'null' : 'value to validate'"
            v-model="row.value"
            @keyup="updateRow"
          >
          <span class="absolute h-full w-8 right-0 pr-3 py-3 z-10 leading-snug text-gray-400 rounded">
            <i v-if="valueErrors.length" class="fas fa-exclamation-circle text-red-400"></i>
            <i v-else class="fas fa-check text-green-500"></i>
          </span>
        </div>

        <div v-if="showSuccessMessage" class="text-green-500">
          Looks good!
        </div>

        <div v-if="valueErrors.length" class="text-red-400">
          {{ valueErrors.toString() }}
        </div>

        <div v-if="! row.disabled && ! row.send_value" class="text-gray-400">
          Row will be validated but {{ valueInputName }} will not be sent.
        </div>

      </div>

      <button
        type="button"
        class="btn ml-1 md:ml-0 bg-yellow-500"
        :title="row.send_value ? 'Disable value' : 'Enable value'"
        @click="toggleRowSendValue"
      >
        <i class="fa fa-fw" :class="row.send_value ? 'fa-eye' : 'fa-eye-slash'"></i>
      </button>

      <button
        type="button"
        class="btn md:ml-1 bg-blue-400"
        title="Null"
        @click="nullRow"
      >
        <i class="fa fa-fw fa-eraser"></i>
      </button>

    </div>

    <hr class="md:hidden my-2">
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
    showSuccessMessage() {
      return this.valueClassName === 'is-valid' && this.ruleClassName === 'is-valid'
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
