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

document.getElementById('examples-menu').addEventListener('click', () => {
  document.getElementById('examples-dropdown').classList.toggle('hidden')
})

document.addEventListener('mouseup', (event) => {
  let dropdown = document.getElementById('examples-dropdown')
  if (! dropdown.contains(event.traget)) {
    dropdown.classList.add('hidden')
  }
})
