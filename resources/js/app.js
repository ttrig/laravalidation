require('./bootstrap')

import Vue from 'vue'
import store from './store/store'
import Laravalidation from './Laravalidation'

Vue.config.productionTip = false

new Vue({
  el: '#main-container',
  store: store,
  components: {
    Laravalidation
  }
})
