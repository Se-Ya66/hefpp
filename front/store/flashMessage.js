export const state = () => ({
  message: "",
  status: false,
})

export const getters = {
  message: (state) => state.message,
  status: (state) => state.status,
}

export const mutations = {
  setMessage(state, message) {
    state.message = message
  },
  setStatus(state, bool) {
    state.status = bool
  },
}

export const actions = {
  showMessage({ commit }, { message, status }) {
    commit("setMessage", message)
    commit("setStatus", status)
    setTimeout(() => {
      commit("setStatus", !status)
    }, 3000)
  },
}