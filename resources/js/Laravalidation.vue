<template>
  <div>
    <ValidationRows/>

    <div class="my-4 text-center space-x-2">
      <ClearButton/>
      <SaveButton/>
      <AddButton/>
    </div>

    <div class="mb-4">
      <ToggleMiddleware />
    </div>
  </div>
</template>

<script>
import ValidationRows from '@/components/ValidationRows.vue'
import ClearButton from '@/components/buttons/ClearButton.vue'
import SaveButton from '@/components/buttons/SaveButton.vue'
import AddButton from '@/components/buttons/AddButton.vue'
import ToggleMiddleware from '@/components/ToggleMiddleware.vue'

export default {
  props: [
    'initialRows',
  ],
  created() {
    try {
      let rows = JSON.parse(this.initialRows)
      _.each(rows, row => this.$store.commit('addRow', row))
      this.$store.dispatch('validate')
    } catch {
      //
    }
  },
  components: {
    ValidationRows,
    ClearButton,
    SaveButton,
    AddButton,
    ToggleMiddleware,
  },
}
</script>
