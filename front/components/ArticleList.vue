<template>
    <div>
        <div class="main-wrapper">
            <v-row justify="center" class="main-inner">
                <v-col cols="3">
                    <div class="control-card">
                        <span>検索条件</span>
                        <div class="keyword-wrapper">
                            <v-text-field 
                            label="キーワードで検索" 
                            color="indigo" 
                            v-model="keyword"
                            clearable
                            class="mr-2"
                            />
                            <v-btn
                            small
                            @click=wordSearch
                            >
                                検索
                            </v-btn>
                        </div>
                        <div class="checkbox-wrapper mb-4">
                            <span>種別</span>
                            <v-checkbox
                            label="生産"
                            value="生産"
                            color="indigo"
                            v-model="showProduction"
                            ></v-checkbox>
                            <v-checkbox
                            label="加工"
                            value="加工"
                            color="indigo"
                            v-model="showProcessing"
                            ></v-checkbox>
                            
                        </div>
                        <div class="checkbox-wrapper">
                            <span class="mb-2">地域</span>
                            <v-autocomplete
                            :items="items"
                            color="indigo"
                            outlined
                            small-chips
                            deletable-chips
                            clearable
                            v-model="showPrefecture"
                            ></v-autocomplete>
                            <v-btn
                            small
                            @click=searchType
                            class="mr-2"
                            >
                                検索
                            </v-btn>
                            <v-btn
                            small
                            @click=resetList
                            >
                                リセット
                            </v-btn>
                        </div>
                        <div class="post-btn-wrapper">
                            <div class="post-btn">
                                <nuxt-link to="/article/post" class="post-txt">
                                    投稿する
                                </nuxt-link>
                            </div>
                        </div>
                    </div>
                </v-col>
                <v-col cols="6">
                    <div v-if="listShow">
                        <div class="article-count">
                            <span>{{result.length}}/{{articles.length}}件</span>
                        </div>
                        <div class="article-item" v-for="(article, id) in result" :key="id">
                            <img src="../static/sample.jpg" class="article-img">
                            <span class="user-type-production">{{article.type}}</span>
                            <h2 class="mt-2 mb-2">{{article.title}}</h2>
                            <p>{{article.body}}</p>
                            <div class="article-user ">
                                <v-avatar size="40">
                                    <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                                </v-avatar>
                                <div class="article-userinfo">
                                    <span class="article-user-name">{{newMember(article.user_id)}}</span>
                                    <span>{{article.prefecture}}</span>
                                </div>
                            </div>
                            <nuxt-link :to="`/article/${article.id}`">詳細</nuxt-link>
                        </div>
                    </div>
                    <div v-else>
                        <div class="article-count">
                            <span>{{articles.length}}/{{articles.length}}件</span>
                        </div>
                        <div class="article-item" v-for="(article, id) in articles" :key="id">
                            <img src="../static/sample.jpg" class="article-img">
                            <span class="user-type-production">{{article.type}}</span>
                            <h2 class="mt-2 mb-2">{{article.title}}</h2>
                            <p>{{article.body}}</p>
                            <div class="article-user ">
                                <v-avatar size="40">
                                    <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                                </v-avatar>
                                <div class="article-userinfo">
                                    <span class="article-user-name">{{newMember(article.user_id)}}</span>
                                    <span>{{article.prefecture}}</span>
                                </div>
                            </div>
                            <nuxt-link :to="`/article/${article.id}`">詳細</nuxt-link>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex"

export default {
    data(){
        return{
            listShow:false,
            keyword:'',
            showPrefecture: '',
            showProduction: '',
            showProcessing:'',
            items:[
                '北海道',
                '青森',
                '岩手',
                '宮城',
                '秋田',
                '山形',
                '福島',
                "茨城",
                "栃木",
                "群馬",
                "埼玉",
                "千葉",
                "東京",
                "神奈川",
                "新潟",
                "富山",
                "石川",
                "福井",
                "山梨",
                "長野",
                "岐阜",
                "静岡",
                "愛知",
                "三重",
                "滋賀",
                "京都",
                "大阪",
                "兵庫",
                "奈良",
                "和歌山",
                "鳥取",
                "島根",
                "岡山",
                "広島",
                "山口",
                "徳島",
                "香川",
                "愛媛",
                "高知",
                "福岡",
                "佐賀",
                "長崎",
                "熊本",
                "大分",
                "宮崎",
                "鹿児島",
                "沖縄"
            ],
            result:[]
        }
    },
    created () {
        this.$store.dispatch('article/loadArticles');
        this.$store.dispatch('users/loadMembers');
        this.$store.dispatch('profile/loadProfiles');
    },
    methods: {
        newMember (userId) {
            const idx = this.members.findIndex(p => p.id == userId)
            if(idx < 0){
                return ''
            }
            return this.members[idx].name
        },
        searchType(){
            this.result = [];
            this.listShow = true;
            for(let i=0; i<this.$store.state.article.articles.length; i++){
                let isShow = false;
                if (this.showProcessing && this.showProduction) {
                    return
                }
                if (this.showProduction && this.$store.state.article.articles[i].type == "生産") {
                    isShow = true;
                }
                if (this.showProcessing && this.$store.state.article.articles[i].type == "加工") {
                    isShow = true;
                }
                
                if (this.showPrefecture) {
                    if (this.showPrefecture == this.$store.state.article.articles[i].prefecture) {
                        isShow = true;
                    } else {
                        isShow = false
                    }
                }

                if (isShow) {
                    this.result.push(this.$store.state.article.articles[i]);
                }
            }
            this.showPrefecture= '';
            this.showProduction= '';
            this.showProcessing='';
            return this.result;
        },
        resetList(){
            this.listShow = false;
            this.showPrefecture= '';
            this.showProduction= '';
            this.showProcessing='';
        },
        // wordSearch(){
        //     this.result = [];
        //     this.listShow = true;
        //     if(this.keyword){
        //         for(let i in this.$store.state.article.articles) {
        //             let article = this.$store.state.article.articles[i];
        //             if(article.body.includes(this.keyword)) {
        //                 this.result.push(article);
        //             }
        //             if(article.title.includes(this.keyword)) {
        //                 this.result.push(article);
        //             }
        //         }
        //     }
        //     this.keyword = '';
        //     return this.result;
        // },
        wordSearch(){
            this.result = [];
            this.listShow = true;
            // if(this.keyword){
            //     for(let i in this.$store.state.article.articles) {
            //         let article = this.$store.state.article.articles[i];
            //         if(article.body.includes(this.keyword)) {
            //             this.result.push(article);
            //         }
            //         if(article.title.includes(this.keyword)) {
            //             this.result.push(article);
            //         }
            //     }
            // }
            for(let i=0; i<this.$store.state.article.articles.length; i++){
                let isShow = false;
                if (this.keyword) {
                    if (this.$store.state.article.articles[i].body.includes(this.keyword)) {
                        isShow = true;
                    } else {
                        isShow = false
                    }
                    if (this.$store.state.article.articles[i].title.includes(this.keyword)) {
                        isShow = true;
                    } else {
                        isShow = false
                    }
                }
                if (isShow) {
                    this.result.push(this.$store.state.article.articles[i]);
                }
            }
            this.keyword = '';
            return this.result;
        },
    },
    computed:{
        ...mapState('article', [
            'articles',
        ]),
        ...mapState('users', [
            'members',
        ]),
        ...mapState('profile', [
            'profiles',
        ]),
        // filteredList() {
        //     let newList = [];   
        //     for(let i=0; i<this.$store.state.article.articles.length; i++){
        //         let isShow = false;
        //         if (this.showProcessing && this.showProduction) {
        //             return
        //         }
        //         if (this.showProduction && this.$store.state.article.articles[i].type == "生産") {
        //             isShow = true;
        //         }
        //         if (this.showProcessing && this.$store.state.article.articles[i].type == "加工") {
        //             isShow = true;
        //         }
                
        //         if (this.showPrefecture) {
        //             if (this.showPrefecture == this.$store.state.article.articles[i].prefecture) {
        //                 isShow = true;
        //             } else {
        //                 isShow = false
        //             }
        //         }

        //         if (isShow) {
        //             this.result.push(this.$store.state.article.articles[i]);
                    
        //         }
        //     }
            

        //     return this.result;
        // },
        // filteredList() {
        //     if (this.showProcessing && this.showProduction) {
        //         return
        //     }
        //     if(this.showProduction){
        //         this.articles.forEach(article =>{
        //             if(article.type === '生産'){
        //                 this.result.push(article);
        //             }
        //         })
        //     }
        //     if(!this.showProcessing && !this.showProduction && !this.showPrefecture ){
        //         this.articles = this.result;
        //     } 
        // },
        
        
        
    },
    
}
</script>

<style lang="scss">
.main-wrapper{
        padding:100px 0;
        width:100%;
    .main-inner{
        width:100%;
        .control-card{
            padding:20px 0;
            .keyword-wrapper{
                display:flex;
                align-items: center;
            }
            .checkbox-wrapper{
                margin-bottom:10px;
            }
            .post-btn-wrapper{
                border-top:2px solid #f5f5f5;
                padding-top:10px;
                .post-btn{
                    background: linear-gradient(to right, #3a7bd5, #00d2ff);
                    height: 80px;
                    line-height: 80px;
                    padding:2px 12px;
                    font-size: 1.2rem;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top:10px;
                    .post-txt{
                        color:white;
                        text-decoration: none;
                        display: block;
                    }
                }
                .post-btn:hover{
                    opacity: 0.8;
                }
            }
        }
        .article-count{
            border-bottom:2px solid #f5f5f5;
            padding-bottom:10px;
            max-width:550px;
            font-weight: bold;
            font-size:1.3rem;
        }
        .article-item{
            max-width:550px;
            border-bottom:2px solid #f5f5f5;
            padding:20px 0;
            .article-img{
                width:100%;
                height:220px;
                object-fit: cover;
                margin-bottom:10px;
            }
            .article-user{
                display: flex;
                .article-userinfo{
                    margin-left:10px;
                    .article-user-name{
                        display:block;
                        font-size:1.1rem;
                        font-weight:bold;
                    }
                    .article-user-prefecture{
                        display:block;
                    }
                }
            }
        }
    }
}
</style>