export const state = () => ({
    messages: [],
})

export const getters = {
    getMessages: (state) => state.messages,
    
}

export const mutations = {
    showMessages (state, messages) {
        state.messages = messages
    },
    createMessages(state, data){
        state.messages.push(data)
    },
    
}

export const actions = {
    async postMessages({ commit }, send){
        const data = await this.$axios.$post(`/${send.id}/messages`,
        {
            message:send.text
        })
        .catch(err => {
            console.log(err)
        })
        commit('createMessages', data)
    },
    show({commit} , receiveId){
        this.$axios.get('/messages/' + receiveId).then(data =>{
            let message = data.data
            commit('showMessages', message)
        })
        .catch(error=>{
            console.log(error)
        })
    },
    
}