<template>
    <div>
        <Header />
        <div class="my-article-wrapper">
            <v-container>
                <v-row >
                    <v-col 
                    v-for="(article, id) in myArticles" :key="id"
                    cols="12" sm="4" md="4" lg="4"
                    >
                        <v-card
                        class="pa-2 article-card"
                        tile
                        >
                            <nuxt-link :to="`/article/${article.id}`">
                                <img :src="`https://${AWS}.s3.ap-northeast-1.amazonaws.com/${article.file_path}`" class="user-article-img" v-if="article.file_path">
                                <img src="../../../static/noimagemini.jpg" class="user-article-img" v-else>
                            </nuxt-link>
                            <h2 class="card-title">
                                {{article.title}}
                            </h2>
                            <p class="card-body">
                                {{article.body}}
                            </p>
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
                                        @click.stop="openDialog(article)"
                                        >
                                            投稿を削除する
                                        </v-btn>
                                    </v-list-item-content>
                                </v-list>
                            </v-menu>
                        </v-card>
                    </v-col>
                    <v-dialog 
                    v-model="dialog" 
                    v-if="currentArticle" 
                    max-height="200"
                    max-width="500"
                    activator
                    >
                        <v-card>
                            <v-cpntainer>
                                <v-card-title>
                                削除してもよろしいでしょうか？
                                </v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                    dark
                                    color="red"
                                    @click="destroyArticle(currentArticle)"
                                    >
                                        削除
                                    </v-btn>
                                    <v-btn
                                    dark
                                    color="green"
                                    @click="dialog = false"
                                    >
                                        キャンセル
                                    </v-btn>
                                </v-card-actions>
                            </v-cpntainer>
                        </v-card>
                    </v-dialog>
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
    middleware: 'auth',
    components:{
        Header,
        Footer,
    },
    data(){
        return{
            dialog:false,
            currentArticle:null,
            AWS:process.env.AWS_BUCKET
        }
    },
    created() {
        this.$store.dispatch('article/loadArticles');
        this.$store.dispatch('profile/loadProfiles');
    },
    methods: {
        destroyArticle(article){
            this.$store.dispatch('article/delete',article);
            this.dialog = false;
        },
        openDialog(article){
            this.currentArticle = article;
            this.dialog = true;
        }
    },
    computed:{
        ...mapState('article', [
            'articles',
        ]),
        ...mapState('profile', [
            'profiles',
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
        height:300px;
        .card-title{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 10px 10px 10px 0;
        }
        .card-body{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .edit-dots-btn{
            position:absolute;
            bottom:5px;
            right:5px;
        }
        .user-article-img{
            width:100%;
            height:50%;
            object-fit: cover;
        }
    }
    
}
</style>