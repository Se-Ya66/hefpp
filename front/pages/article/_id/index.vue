<template>
    <div>
        <Header />
        <div class="article-detail-wrapper">
            <v-container>
                <div v-show="show">{{article}}</div>
                <span class="user-type-production">生産</span>
                <h2 class="article-title">{{article.title}}</h2>
                <div class="article-user mb-3">
                    <v-avatar size="40">
                        <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                    </v-avatar>
                    <div class="article-userinfo">
                        <span class="article-user-name">株式会社ケイアンドカンパニー</span>
                        <div class="article-user-prefecture">愛知</div>
                    </div>
                </div>
                <p>{{article.created_at}}</p>
                <img src="../../../static/sample.jpg" class="article-img">
                <v-container>
                    <div class="article-bottom-wrapper">
                        <v-row justify="space-between">
                            <v-col cols="9">
                                <div class="article-detail-sentence">
                                    <h2>詳細</h2>
                                    <p>
                                        {{article.body}}
                                    </p>
                                    <h2>条件</h2>
                                    <p>
                                        {{article.conditions}}
                                    </p>
                                </div>
                            </v-col>
                            <v-col cols="2">
                                <div class="like-btn">
                                    <article-like :post="article"/>
                                </div>
                            </v-col>
                        </v-row>
                    </div>
                </v-container>
            </v-container>
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import articlelike from '~/components/ArticleLike.vue'

import { mapState } from "vuex"

export default {
    components:{
        Header,
        Footer,
        articlelike
    },
    data(){
        return{
            show:false
        }
    },
    created () {
        this.$store.dispatch('article/show',this.$route.params.id);
    },
    computed:{
        ...mapState('article', [
            'article',
        ]),
    },
}
</script>

<style lang="scss">
.article-detail-wrapper{
    width:80%;
    margin:0 auto;
    padding:$page-pt 0;
    .article-title{
        margin:10px 0;
        font-size:1.5rem;
    }
    .article-user{
        display: flex;
        .article-userinfo{
            margin-left:10px;
            .article-user-name{
                font-size:1.1rem;
                color:$grey;
                font-weight:bold;
            }
            .article-user-prefecture{
                font-size:1rem;
            }
        }
    }
    .article-img{
        width:100%;
        height:400px;
        object-fit: cover;
    }
    .article-bottom-wrapper{
        .article-detail-sentence{
            h2{
                font-size:1.4rem;
                margin-bottom: 10px;
                color:$grey;
            }
            p{
                font-size:1.1rem;
            }
        }
    }
}
</style>