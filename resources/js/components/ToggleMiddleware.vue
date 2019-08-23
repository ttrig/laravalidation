<template>
  <div class="col-md-12 mb-3 text-center">
    <div class="custom-control custom-switch">
      <input
        type="checkbox"
        class="custom-control-input"
        id="i-toggle-middleware"
        v-model="checked"
        @change="change"
      >
      <label class="custom-control-label" for="i-toggle-middleware">
        Use <code>ConvertEmptyStringsToNull</code> middleware
      </label>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      checked: true
    }
  },
  methods: {
    change() {
      this.$store.commit('toggleMiddleware', this.checked)
      this.$store.dispatch('validate')
    },
  },
}
</script>
