<template>
  <div>
    <ValidationRows/>
    <div class="my-4 text-center">
      <ClearButton :count="getCount"/>
      <SaveButton :count="getCount"/>
      <AddButton :count="getCount"/>
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
    'json',
  ],
  created() {
    try {
      let rows = JSON.parse(this.json)
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
  computed: {
    getCount() {
      return this.$store.getters.count
    },
  },
}
</script>
