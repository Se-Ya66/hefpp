export const state = () => ({
    profiles: [],
    profile: [],
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
        .catch(error => {
        console.log(error)
        })
    },
    showProfile({commit} , profileId){
        this.$axios.get('/profiles/' + profileId).then(data =>{
            let profile = data.data
            commit('showProfile', profile)
        })
        .catch(error=>{
            console.log(error)
        })
    },
    async create({ commit }, profileData){
        const data = await this.$axios.$post('/profiles', profileData)
        .catch(err => {
            console.log(err)
        })
        commit('setProfile', data)
    },
    async update ({ commit }, profile) {
        const response = await this.$axios.put(`/profiles/${profile.id}`, 
        {
            prefecture:profile.prefecture,
            type:profile.type,
            url:profile.url,
            introduction:profile.introduction,
            address:profile.address,
            tel:profile.tel
        })
        .catch(err => {
            console.log(err)
        })
        commit('setProfile', response)
    }
}