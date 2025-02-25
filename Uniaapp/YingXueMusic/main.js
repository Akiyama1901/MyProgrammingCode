import App from './App'

// #ifndef VUE3
import Vue from 'vue'
import './uni.promisify.adaptor'
import store from './store/account.js'  // 导入 Vuex store

Vue.config.productionTip = false
App.mpType = 'app'

// 创建 Vue 实例时传入 store
const app = new Vue({
  store,  // 在这里传入 store
  ...App
})
app.$mount()
// #endif

// #ifdef VUE3
import { createSSRApp } from 'vue'
import store from './store/account.js'  // 导入 Vuex store

export function createApp() {
  const app = createSSRApp(App)
  app.use(store)  // 在 Vue 3 中使用 app.use(store) 挂载 store
  return {
    app
  }
}
// #endif
