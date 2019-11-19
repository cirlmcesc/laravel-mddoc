/* jshint esversion: 6 */

import Vue from 'vue'
import App from './App.vue'
import 'ant-design-vue/dist/antd.css'
import Antd from 'ant-design-vue'

Vue.prototype.$axios = axios

Vue.config.productionTip = false

Vue.use(Antd)

new Vue({
  el: '#app',
  components: { App },
  template: '<App/>',
})
