<template>
  <transition name="root">
    <form v-if="count" autocomplete="off" novalidate>
      <div class="row text-center d-none d-md-flex">
        <div class="form-group col-md-6">
          <label class="text-muted" v-text="ruleLabel"></label>
        </div>
        <div class="form-group col-md-6">
          <label class="text-muted" v-text="valueLabel"></label>
        </div>
      </div>
      <transition-group name="row-list" tag="div">
        <div v-for="row in rows" :key="row.id">
          <ValidationRow :row="row" />
        </div>
      </transition-group>
    </form>
  </transition>
</template>

<script>
import ValidationRow from './ValidationRow.vue'

export default {
  components: {
    ValidationRow,
  },
  computed: {
    rows() {
      return this.$store.getters.rows
    },
    count() {
      return this.$store.getters.count
    },
    ruleLabel() {
      return this.rows.length > 1 ? 'Rules' : 'Rule'
    },
    valueLabel() {
      return this.rows.length > 1 ? 'Values' : 'Value'
    },
  },
}
</script>

<style scoped>
  .root-enter-active,
  .root-leave-active {
    transition: opacity 0.25s ease-out;
  }
  .root-enter,
  .root-leave-to {
    opacity: 0;
  }

  .row-list-enter-active,
  .row-list-leave-active {
    transition: all 0.2s;
  }

  .row-list-enter,
  .row-list-leave-to {
    opacity: 0;
    transform: translateY(-20px);
  }
</style>
