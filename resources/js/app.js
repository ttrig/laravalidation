import './bootstrap'
import '../css/app.css'
import { createApp } from 'vue'
import store from './store/store'
import Laravalidation from './Laravalidation.vue'

createApp(Laravalidation, {initialRows: document.getElementById('initial-rows').innerHTML})
  .use(store)
  .mount('#app')

document.getElementById('examples-menu').addEventListener('click', () => {
  document.getElementById('examples-dropdown').classList.toggle('hidden')
})

document.addEventListener('mouseup', (event) => {
  let dropdown = document.getElementById('examples-dropdown')
  if (! dropdown.contains(event.traget)) {
    dropdown.classList.add('hidden')
  }
})
