<template>
  <button
    type="button"
    class="btn"
    :class="disable ? 'bg-blue-200' : 'bg-blue-500'"
    :disabled="disable"
    @click="click"
  >
    <i class="fa fa-fw fa-times"></i> Clear
  </button>
</template>

<script>
export default {
  props: ['count'],
  computed: {
    disable() {
      return !this.count
    },
  },
  methods: {
    click() {
      this.$store.commit('deleteAllRows')
    }
  }
}
</script>
