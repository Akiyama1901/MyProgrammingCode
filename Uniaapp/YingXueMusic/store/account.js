import { createStore } from 'vuex'

// 使用 Vuex 创建一个 store
const store = createStore({
  state: {
    userInfo: {
      hasLogin: false  // 默认未登录
    }
  },
  mutations: {
    setLogin(state, status) {
      state.userInfo.hasLogin = status  // 更新登录状态
    }
  },
  actions: {
    login({ commit }) {
      commit('setLogin', true)  // 登录后更新状态
    }
  }
})

export default store
