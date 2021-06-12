export const state = () => ({
    profiles: [],
    profile: {},
})

export const getters = {
    getProfiles: (state) => state.profiles,
    getProfile: (state) => state.profile
}

export const mutations = {
    setProfile (state, profiles) {
        state.profiles = profiles
    },
    showProfile (state, profile) {
        state.profile = profile
    },
    updateProfile (state, response) {
        const idx = state.profiles.findIndex(p => p.user_id == response.user_id)
        state.profiles.splice(idx, 1, response)
    },
    createProfile(state, profile){
        state.profile.push(profile)
    },
}

export const actions = {
    loadProfiles({commit}){
        this.$axios.get('/profiles').then(data =>{
        let profiles = data.data
        commit('setProfile', profiles)
        })
        .catch(err => {
        console.log(err)
        })
    },
    showProfile({commit} , profileId){
        this.$axios.get('/profiles/' + profileId).then(data =>{
            let profile = data.data
            commit('showProfile', profile)
        })
        .catch(err=>{
            console.log(err)
        })
    },
    async create({ commit }, profile){
        const data = await this.$axios.$post('/profiles', profile)
        .catch(err => {
            console.log(err)
        })
        commit('updateProfile', data)
    },
    async update ({ commit }, {userId, profile}) {
        const response = await this.$axios.$put(`/profiles/${userId}`, profile)
        .catch(err => {
            console.log(err)
        })
        commit('updateProfile', response)
    },
    async updateImage ({ commit }, profile) {
        const response = await this.$axios.put(`/${profile.id}/image`, 
        {
            image:profile.image,
        })
        .catch(err => {
            console.log(err)
        })
        commit('setProfile', response)
        console.log(profile.image);
    },

    async updateImage ({ commit }, {userId, userImage}) {
        const response = await this.$axios.post(`/${userId}/image`, 
            {file:userImage}
        )
        .catch(err => {
            console.log(err)
        })
        commit('setProfile', response)
    },

}