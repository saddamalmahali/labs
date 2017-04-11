// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueResource from 'vue-resource'
import App from './App'
import Dashboard from './components/Dashboard'
import Chat from './components/pages/Chat'
import router from './router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import locale from 'element-ui/lib/locale/lang/id'
import store from './store'

Vue.use(VueResource)
Vue.use(ElementUI, {locale})
Vue.config.productionTip = false

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const authUser = JSON.parse(window.localStorage.getItem('auth_user'))
    if (authUser && authUser.access_token) {
      next()
    } else {
      next({path: '/'})
    }
  }
  next()
})
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App, Dashboard, Chat }
})
