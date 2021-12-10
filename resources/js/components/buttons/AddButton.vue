<template>
  <button
    type="button"
    class="btn"
    :class="{
      'p-4': !$store.getters.count,
      'bg-green-500': !disable,
      'bg-green-300': disable,
    }"
    :disabled="disable"
    :title="title"
    @click="click"
  >
    <i class="fa fa-fw fa-plus"></i> Add row
  </button>
</template>

<script>
export default {
  computed: {
    disable() {
      return this.$store.getters.rowLimitReached
    },
    limitReached() {
      return this.$store.getters.count >= 6
    },
    title() {
      if (this.$store.getters.rowLimitReached) {
        return 'Max rows reached.'
      }
    },
  },
  methods: {
    click() {
      this.$store.commit('addRow')
      this.$store.dispatch('validate')
    },
  },
}
</script>

<style scoped>
.bg-green-500 {
  transition: 0.4s;
}
</style>
