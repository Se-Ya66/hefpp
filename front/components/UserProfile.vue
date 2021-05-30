<template>
    <div>
        <div class="user-wrapper">
            <v-card class="user-top pa-6">
                <v-container>
                    <div class="uer-top-inner">
                        <div class="mr-6">
                            <div v-if="!profile.file_path">
                                <v-icon large>
                                    mdi-account
                                </v-icon>
                            </div>
                            <div v-else>
                                <v-avatar size="70">
                                    <img :src="profile.file_path">
                                </v-avatar>
                            </div>
                        </div>
                        <div>
                            <h1>{{member.name}}</h1>
                            <div class="user-box">
                                <span class="user-type">{{profile.type}}</span>
                                <span class="user-pre">
                                <v-icon>
                                    mdi-map-marker
                                </v-icon>
                                {{profile.prefecture}}
                                </span>
                            </div>
                            <div class="user-box mb-2">
                                <span>
                                    <v-icon>
                                        mdi-link-variant
                                    </v-icon>
                                    <a href="https://www.yahoo.co.jp/">{{profile.url}}</a>
                                </span>
                            </div>
                            <follow-button :userId="$route.params.id"/>
                        </div>
                    </div>
                </v-container>
            </v-card>
            <div class="user-bottom mt-3">
                <v-tabs
                color="indigo"
                centered>
                    <v-tab>
                        プロフィール
                    </v-tab>
                    <v-tab>
                        投稿一覧
                    </v-tab>
                    <v-tab>
                        フォロー
                    </v-tab>
                    <v-tab>
                        フォロワー
                    </v-tab>
                    <v-tab-item>
                        <v-container >
                            <div class="user-item">
                                <h1>紹介</h1>
                                <v-container>
                                <div>
                                    {{profile.introduction}}
                                </div>
                                </v-container>
                            </div>
                            <div class="user-item">
                                <h1>企業情報</h1>
                                <v-container>
                                <div class="info-item">
                                    <h2>{{member.name}}</h2>
                                    <ul>
                                        <li>
                                            <v-icon>
                                                mdi-map-marker
                                            </v-icon>
                                            {{profile.address}}
                                        </li>
                                        <li>
                                            <v-icon>
                                                mdi-link-variant
                                            </v-icon>
                                            <a href="https://www.yahoo.co.jp/">{{profile.url}}</a>
                                        </li>
                                        <li>
                                            <v-icon>
                                                mdi-phone
                                            </v-icon>
                                            {{profile.tel}}
                                        </li>
                                        <li>
                                            <v-icon>
                                                mdi-flag
                                            </v-icon>
                                            2019/9 に設立
                                        </li>
                                    </ul>
                                </div>
                                </v-container>
                            </div>
                        </v-container>
                    </v-tab-item>
                    <v-tab-item>
                        <v-container>
                            <div class="user-item">
                                <h1>募集</h1>
                                <v-container>
                                    <v-row>
                                        <v-col 
                                        v-for="(article, id) in myArticles" :key="id"
                                        cols="10" sm="10" md="12" lg="12"
                                        >
                                            <v-card
                                            class="recruit-card pa-2"
                                            tile
                                            :to="`/article/${article.id}`"
                                            >
                                                <img src="../static/sample.jpg" class="article-img">
                                                    <h2 class="card-title">
                                                        {{article.title}}
                                                    </h2>
                                                    <p class="card-body">
                                                        {{article.body}}
                                                    </p>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </div>
                        </v-container>
                    </v-tab-item>
                    <v-tab-item>
                        <follow-list />
                    </v-tab-item>
                    <v-tab-item>
                        <follower-list />
                    </v-tab-item>
                </v-tabs>
            </div>
        </div>
    </div>
</template>

<script>
import followbutton from '~/components/FollowButton.vue'
import followlist from '~/components/FollowList.vue'
import followerlist from '~/components/FollowerList.vue'

import { mapActions, mapGetters, mapState } from 'vuex';

export default {
    components:{
        followbutton,
        followlist,
        followerlist,
    },
    data(){
        return{
            show:true
        }
    },
    created () {
        this.$store.dispatch('article/loadArticles');
        this.$store.dispatch('profile/showProfile',this.$route.params.id);
        this.$store.dispatch('users/show',this.$route.params.id);
    },
    computed:{
        ...mapState('article', [
            'articles',
        ]),
        ...mapState('profile', [
            'profile',
        ]),
        ...mapState('users', [
            'member',
        ]),
        myArticles(){
            let num = Number(this.$route.params.id);
            const posts = this.articles.filter(item => item.user_id === num);
            return posts;
        },
        
    },
    
}
</script>

<style lang="scss">
.user-wrapper{
    width:100%;
    padding:60px 0 $page-pt;
    .user-top{
        width:100%;
        .uer-top-inner{
            width:60%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            @include sp {
                width:90%;
            };
            h1{
                font-size:20px;
            }
            .user-box{
                display: flex;
                align-items: center;
                margin-top:10px ;
                span:nth-child(1){
                    margin-right: 20px;
                }
                .user-type{
                    background-color:orange ;
                    color:white;
                    padding:5px;
                    border-radius:5px;
                }
                .user-pre{
                    color:grey;
                }
                
            }
        }
    }
    .user-bottom{
        width:60%;
        margin:0 auto;
        @include sp {
            width:90%;
        };
        .user-item{
            margin:20px;
            .recruit-card{
                height:200px;
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
            }
            h1{
                font-size:1.5rem;
                color: #9da0a4;
            }
            p{
                font-size:1.1rem;
            }
            img{
                width:100%;
                height:60%;
                object-fit: cover;
            }
            .recruit-item{
                max-width:400px;
            }
            .info-item{
                h2{
                    margin-bottom: 20px;
                }
                li{
                    margin-bottom: 10px;
                    font-size:13px;
                }
            }
            .article-img{
                width:100%;
                object-fit: cover;
            }
        }
    }
}
</style>