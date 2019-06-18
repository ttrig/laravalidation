<template>
  <button
    type="button"
    class="btn btn-success"
    :class="{ 'btn-lg': !count }"
    :disabled="limitReached"
    :title="title"
    @click="click"
  >
    <i class="fa fa-plus"></i> Add row
  </button>
</template>

<script>
export default {
  props: ['count'],
  computed: {
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
.btn-success {
  transition: 0.4s;
}
</style>
