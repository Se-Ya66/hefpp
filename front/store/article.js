export const state = () => ({
    articles: [],
    article: {},
    message:''
})

export const getters = {
    getArticles: (state) => state.articles,
    getArticle: (state) => state.article
}

export const mutations = {
    setArticles (state, articles) {
        state.articles = articles
    },
    createArticles(state, data){
        state.articles.push(data)
    },
    updateArticle (state, response) {
        const idx = state.articles.findIndex(p => p.user_id == response.user_id)
        state.articles.splice(idx, 1, response)
    },
    deleteArticles(state, index) {
        state.articles.splice(index, 1);
    },
    showArticles(state, article){
        state.article = article
    },
    setMessage(state, message){
        state.message = message
    }
}

export const actions = {
    loadArticles({commit}){
        this.$axios.get('/articles').then(data =>{
        // let articles = data.data
        let articles = data.data.result.data
        commit('setArticles', articles)
        })
        .catch(err => {
        console.log(err)
        })
    },
    // loadPosts({commit}, page){
    //     this.$axios.get('/articles', {
    //         params: {
    //             page: parseInt(page),
    //         },
    //     }).then(res =>{
    //         let articles = res.data.result
    //         commit('setArticles', articles)
    //         console.log(articles)
    //     })
    //     .catch(err => {
    //         console.log(err)
    //     })
    // },
    async postArticles({ commit }, article){
        const data = await this.$axios.post('/articles', article)
        .catch(err => {
            console.log(err)
            commit('setMessage', err.response.data.errors.file[0])
        })
        commit('createArticles', data)
    },
    delete({state, commit}, article){
        const index = state.articles.indexOf(article);
        this.$axios.delete('/articles/'+ article.id).then(res =>{
            commit('deleteArticles', index);
        })
        .catch(err=>{
            console.log(err)
        })
    },
    show({commit} , articleId){
        this.$axios.get('/articles/' + articleId).then(data =>{
            let article = data.data
            commit('showArticles', article)
        })
        .catch(err=>{
            console.log(err)
        })
    },
    async update ({ commit }, {articleId, article}) {
        const response = await this.$axios.put(`/articles/${articleId}`, article)
        .catch(err => {
            console.log(err)
        })
        commit('updateArticle', response)
    },
    
}