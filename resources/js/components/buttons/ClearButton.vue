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
import { store } from '@/store.js'

export default {
  computed: {
    disable() {
      return ! store.rows.length
    },
  },
  methods: {
    click() {
      store.deleteAllRows()
    }
  }
}
</script>
