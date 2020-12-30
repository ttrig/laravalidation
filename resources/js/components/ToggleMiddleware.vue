<template>
  <div class="mb-3 text-center">
    <input
      type="checkbox"
      id="i-toggle-middleware"
      v-model="checked"
      @change="change"
    >
    <label for="i-toggle-middleware">
      Use <code class="text-pink-500">ConvertEmptyStringsToNull</code> middleware
    </label>
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
