<template>
  <button
    type="button"
    class="btn"
    :class="{
      'p-4': !count,
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
  props: ['count'],
  computed: {
    disable() {
      return this.limitReached
    },
    limitReached() {
      return this.count >= 6
    },
    title() {
      if (this.limitReached) {
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
