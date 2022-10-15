import Vue from 'vue'
import App from './App'
import headerVue from './components/headerVue.vue'
import registration from './components/registration'
import footerVue from './components/footerVue'
import home from './components/home'
import courses from './components/courses'
import contats from './components/contacts'
import router from './router'

Vue.config.productionTip = false

new Vue({
  el: '#app',
  template: '<App/>',
  components: {App}
})
