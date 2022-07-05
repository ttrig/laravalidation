<template>
  <button
    type="button"
    class="btn"
    :class="{
      'p-4': ! store.rows.length,
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
import { store } from '@/store.js'

export default {
  data() {
    return {
      store
    }
  },
  computed: {
    disable() {
      return this.limitReached
    },
    limitReached() {
      return this.store.rows.length >= 6
    },
    title() {
      if (this.limitReached) {
        return 'Max rows reached.'
      }
    },
  },
  methods: {
    click() {
      this.store.addRow()
      this.store.validate()
    },
  },
}
</script>

<style scoped>
.bg-green-500 {
  transition: 0.4s;
}
</style>
