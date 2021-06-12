export const state = () => ({
    members: [],
    member: [],
})

export const getters = {
    getMembers: (state) => state.members,
    getMember: (state) => state.member
}

export const mutations = {
    setMembers (state, members) {
        state.members = members
    },
    showMember(state, member){
        state.member = member
    },
}

export const actions = {
    loadMembers({commit}){
        this.$axios.get('/users').then(data =>{
        let members = data.data
        commit('setMembers', members)
        })
        .catch(err => {
        console.log(err)
        })
    },
    show({commit} , memberId){
        this.$axios.get('/users/' + memberId).then(data =>{
            let member = data.data
            commit('showMember', member)
        })
        .catch(err=>{
            console.log(err)
        })
    },
    async update ({ commit }, member) {
        const response = await this.$axios.put(`/users/${member.id}`, 
        {
            name:member.name, 
            email:member.email,
        })
        .catch(err => {
            console.log(err)
        })
        commit('setMembers', response)
    },
    async updatePassword ({ commit }, member) {
        const response = await this.$axios.put(`/${member.id}/change`, 
        {
            current_password:member.current_password, 
            new_password:member.new_password,
        })
        .catch(err => {
            console.log(err)
        })
        commit('setMembers', response)
    },
}