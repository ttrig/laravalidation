<template>
  <transition name="root">
    <form v-if="store.rows.length" autocomplete="off" novalidate>
      <div class="w-full hidden md:flex justify-around mb-2">
        <label class="border py-1 px-2 rounded bg-gray-100 text-gray-400" v-text="ruleLabel"></label>
        <label class="border py-1 px-2 rounded bg-gray-100 text-gray-400" v-text="valueLabel"></label>
      </div>
      <transition-group name="row-list" tag="div">
        <div v-for="row in store.rows" :key="row.id">
          <ValidationRow :row="row" />
        </div>
      </transition-group>
    </form>
  </transition>
</template>

<script>
import { store } from '@/store.js'
import ValidationRow from './ValidationRow.vue'

export default {
  data() {
    return {
      store
    }
  },
  components: {
    ValidationRow,
  },
  computed: {
    ruleLabel() {
      return this.store.rows.length > 1 ? 'rules' : 'rule'
    },
    valueLabel() {
      return this.store.rows.length > 1 ? 'values' : 'value'
    },
  },
}
</script>

<style scoped>
  .root-enter-active,
  .root-leave-active {
    transition: opacity 0.25s ease-out;
  }
  .root-enter-from,
  .root-leave-to {
    opacity: 0;
  }

  .row-list-enter-active,
  .row-list-leave-active {
    transition: all 0.2s;
  }

  .row-list-enter-from,
  .row-list-leave-to {
    opacity: 0;
    transform: translateY(-20px);
  }
</style>
