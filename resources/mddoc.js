/* jshint esversion: 6 */

import Vue from 'vue'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import MarkdownMenu from './components/MarkdownMenu.vue'
import MarkdownContent from './components/MarkdownContent.vue'
import 'github-markdown-css'
import jQuery from 'jquery'

Vue.use(Antd)

Vue.component('MarkdownMenu', require('./components/MarkdownMenu.vue'))
Vue.component('MarkdownContent', require('./components/MarkdownContent.vue'))

NProgress.configure({ showSpinner: false }) // NProgress Configuration
NProgress.start();

Vue.prototype.$jQuery = jQuery

new Vue({
  el: '#app',
  components: {
    "m-menu": MarkdownMenu,
    "m-content": MarkdownContent,
  },
})
