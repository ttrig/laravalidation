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
import { store } from '@/store.js'
import ValidationRows from '@/components/ValidationRows.vue'
import ClearButton from '@/components/buttons/ClearButton.vue'
import SaveButton from '@/components/buttons/SaveButton.vue'
import AddButton from '@/components/buttons/AddButton.vue'
import ToggleMiddleware from '@/components/ToggleMiddleware.vue'

export default {
  created() {
    try {
      let rows = JSON.parse(document.getElementById('initial-rows').innerHTML)
      _.each(rows, row => store.addRow(row))
      store.validate()
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
