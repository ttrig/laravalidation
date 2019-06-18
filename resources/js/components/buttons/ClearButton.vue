<template>
  <button
    type="button"
    class="btn btn-primary"
    :disabled="!count"
    @click="click"
  >
    <i class="fa fa-times"></i> Clear
  </button>
</template>

<script>
export default {
  props: ['count'],
  methods: {
    click() {
      this.$store.commit('deleteAllRows')
    }
  }
}
</script>
