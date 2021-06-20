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
    showArticle(state, article){
        state.article = article
    },
    setMessage(state, message){
        state.message = message
    }
}

export const actions = {
    loadArticles({commit}){
        this.$axios.get('/articles').then(data =>{
        let articles = data.data.result.data
        commit('setArticles', articles)
        })
        .catch(err => {
        console.log(err)
        })
    },
    async postArticles({ commit }, article) {
        await new Promise((resolve, reject) => {
            const data = this.$axios.post('/articles', article)
            .then(response => {
                resolve(response)
            }).catch(error => {
                reject(error)
            }).finally(() => {
                commit('createArticles', data)
            })
        })
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
            commit('showArticle', article)
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