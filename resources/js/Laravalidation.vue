<template>
  <div>
    <ValidationRows/>
    <div class="row">
      <div class="col-md-12 mb-3 text-center">
      <ClearButton :count="getCount"/>
      <SaveButton :count="getCount"/>
      <AddButton :count="getCount"/>
      </div>
    </div>
    <div class="row">
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

export default {
  created() {
    try {
      let rows = JSON.parse($('#json-rows').text())
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
  },
  computed: {
    getCount() {
      return this.$store.getters.count
    },
  },
}
</script>
