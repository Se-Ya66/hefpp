export const state = () => ({
    articles: [],
    article: [],
    
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
    deleteArticles(state, index) {
        state.articles.splice(index, 1);
    },
    showArticles(state, article){
        state.article = article
    },
}

export const actions = {
    loadArticles({commit}){
        this.$axios.get('/articles').then(data =>{
        let articles = data.data
        commit('setArticles', articles)

        })
        .catch(error => {
        console.log(error)
        })
    },
    async postArticles({ commit }, article){
        const data = await this.$axios.post('/articles', article)
        .catch(err => {
            console.log(err)
        })
        commit('createArticles', data)
    },
    delete({state, commit}, article){
        const index = state.articles.indexOf(article);
        this.$axios.delete('/articles/'+ article.id).then(res =>{
            commit('deleteArticles', index);
        })
        .catch(error=>{
            console.log(error)
        })
    },
    show({commit} , articleId){
        this.$axios.get('/articles/' + articleId).then(data =>{
            let article = data.data
            commit('showArticles', article)
        })
        .catch(error=>{
            console.log(error)
        })
    },
    async update ({ commit }, {articleId, article}) {
        const response = await this.$axios.put(`/articles/${articleId}`, article)
        .catch(err => {
            console.log(err)
        })
        commit('setArticles', response)
    },
    
}