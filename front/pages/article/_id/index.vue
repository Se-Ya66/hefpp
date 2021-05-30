<template>
    <div>
        <Header />
        <div class="article-detail-wrapper">
            <v-container>
                <div v-show="show">{{article}}</div>
                <span class="user-type-production">{{article.type}}</span>
                <span>{{article.prefecture}}</span>
                <h2 class="article-title">{{article.title}}</h2>
                <div class="article-user mb-3">
                    <v-avatar size="40">
                        <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                    </v-avatar>
                    <div class="article-userinfo">
                        <span class="article-user-name">{{newMember(article.user_id)}}</span>
                    </div>
                </div>
                <p>{{article.created_at}}</p>
                <img :src="article.file_path" class="article-img">
                <v-container>
                    <div class="article-bottom-wrapper">
                        <v-row justify="space-between">
                            <v-col cols="8" sm="9" md="9" lg="9">
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
                            <v-col cols="4" sm="2" md="2" lg="2">
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
        ...mapState('users', [
            'members',
        ]),
    },
    methods:{
        newMember(userId){
            const idx = this.members.findIndex(p => p.id == userId)
            if(idx < 0){
                return ''
            }
            return this.members[idx].name
        },
    }
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
        @include sp {
            font-size:1.2rem;
        };
    }
    .article-user{
        display: flex;
        .article-userinfo{
            margin-left:10px;
            .article-user-name{
                font-size:1.1rem;
                color:$grey;
                font-weight:bold;
                @include sp {
                    font-size:0.8rem;
                };
            }
            .article-user-prefecture{
                font-size:1rem;
                @include sp {
                    font-size:0.6rem;
                };
            }
        }
    }
    .article-img{
        width:100%;
        height:200px;
        object-fit: cover;
        @include sp {
            height:100px;
        };
    }
    .article-bottom-wrapper{
        .article-detail-sentence{
            h2{
                font-size:1.4rem;
                margin-bottom: 10px;
                color:$grey;
                @include sp {
                    font-size:1rem;
                };
            }
            p{
                font-size:1.1rem;
                @include sp {
                    font-size:0.8rem;
                };
            }
        }
    }
}
</style>