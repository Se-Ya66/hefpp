<template>
    <div>
        <Header />
        <div class="my-article-wrapper">
            <v-container>
                <v-row>
                    <v-col 
                    v-for="(article, id) in myArticles" :key="id"
                    cols="4"
                    >
                        <v-card
                        class="pa-2 article-card"
                        tile
                        >
                            <nuxt-link :to="`/article/${article.id}`">
                                <img src="../../../static/sample.jpg" class="article-img">
                            </nuxt-link>
                            <v-card-title>{{article.title}}</v-card-title>
                            <v-card-text>{{article.body}}</v-card-text>
                            <v-menu
                            top
                            offset-x>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                    icon
                                    v-bind="attrs"
                                    v-on="on"
                                    class="edit-dots-btn"
                                    >
                                        <v-icon>
                                            mdi-dots-vertical
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item-content
                                    >
                                        <v-btn
                                        text
                                        depressed
                                        :to="`/article/${article.id}/edit`"
                                        >
                                            投稿を編集する
                                        </v-btn>
                                        <v-divider class="my-3"></v-divider>
                                        <v-btn
                                        text
                                        depressed
                                        @click="dialog=true"
                                        >
                                            投稿を削除する
                                        </v-btn>
                                    </v-list-item-content>
                                </v-list>
                            </v-menu>
                        </v-card>
                        <transition name="confirm">
                            <div class="bg" v-show="dialog">
                                <div 
                                class="bg-inner overflow-y-auto mx-auto my-10"
                                width="100%"
                                max-height="200"
                                max-width="500"
                                >
                                    <p class="mb-6">削除してよろしいでしょうか？</p>
                                    <div class="btn-wrapper">
                                        <div
                                        class="edit-btn delete-btn"
                                        @click="destroyArticle(article)"
                                        >
                                            削除
                                        </div>
                                        <div
                                        class="edit-btn ml-2"
                                        @click="dialog=false"
                                        >
                                            キャンセル
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </v-col>
                </v-row>
            </v-container>
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'

import { mapState } from "vuex"

export default {
    components:{
        Header,
        Footer,
    },
    data(){
        return{
            dialog:false,
        }
    },
    mounted () {
        this.$store.dispatch('article/loadArticles');
    },
    methods: {
        destroyArticle(articleId){
            this.$store.dispatch('article/delete',articleId);
            this.$router.go({path: this.$router.currentRoute.path, force: true})
        }
    },
    computed:{
        ...mapState('article', [
            'articles',
        ]),
        myArticles(){
            let num = Number(this.$route.params.id);
            const posts = this.articles.filter(item => item.user_id === num);
            return posts;
        }
    },
}
</script>

<style lang="scss">
.my-article-wrapper{
    padding:$page-pt 0;
    font-size: 1.1rem;
    .article-card{
        position: relative;
        .edit-dots-btn{
            position:absolute;
            bottom:5px;
            right:5px;
        }
    }
    .article-img{
        width:100%;
        object-fit: cover;
    }
    .delete-btn{
        background: linear-gradient(to right, #BD3F32, #CB356B);
    }
}
</style>