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

    <div class="mb-4">
      <HashUrl/>
      <Base64Url/>
    </div>
  </div>
</template>

<script>
import ValidationRows from '@/components/ValidationRows.vue'
import ClearButton from '@/components/buttons/ClearButton.vue'
import SaveButton from '@/components/buttons/SaveButton.vue'
import AddButton from '@/components/buttons/AddButton.vue'
import HashUrl from '@/components/HashUrl.vue'
import Base64Url from '@/components/Base64Url.vue'
import ToggleMiddleware from '@/components/ToggleMiddleware.vue'

export default {
  props: [
    'initialRows',
  ],
  created() {
    try {
      let rows = JSON.parse(this.initialRows)
      _.each(rows, row => this.$store.commit('addRow', row))
      this.$store.commit('setSavedRows')
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
    HashUrl,
    Base64Url,
    ToggleMiddleware,
  },
}
</script>
