<template>
    <div>
        <div class="main-wrapper">
            <v-row justify="center" class="main-inner">
                <v-col cols="3" sm="3" md="3" lg="3">
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
                            class="mr-3"
                            ></v-checkbox>
                            <v-checkbox
                            label="加工"
                            value="加工"
                            color="indigo"
                            v-model="showProcessing"
                            ></v-checkbox>
                        </div>
                        <div class="prefecture-select-wrapper">
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
                            <div class="post-btn" @click="goPostPage">
                                投稿する
                            </div>
                        </div>
                    </div>
                </v-col>
                <v-col cols="11" sm="6" md="6" lg="6">
                    <div v-if="listShow">
                        <div class="article-count">
                            <span>{{result.length}}/{{articles.length}}件</span>
                        </div>
                        <div class="article-item" v-for="(article, id) in displayResult" :key="id">
                            <nuxt-link :to="`/article/${article.id}`">
                                <!-- <img :src="article.file_path" class="article-img" v-if="article.file_path"> -->
                                <img :src="`https://${AWS}.s3.ap-northeast-1.amazonaws.com/${article.file_path}`" class="article-img" v-if="article.file_path">
                                <img src="../static/noimage.jpg" class="article-img" v-else>
                            </nuxt-link>
                            <span class="user-type-production">{{article.type}}</span>
                            <span class="ml-3">{{article.prefecture}}</span>
                            <h2 class="mt-2 mb-2">{{article.title}}</h2>
                            <p>{{article.body}}</p>
                            <div class="article-user ">
                                <nuxt-link :to="`/user/${article.user_id}`">
                                    <v-avatar size="40">
                                        <img :src="newIcon(article.user_id)">
                                    </v-avatar>
                                </nuxt-link>
                                <div class="article-userinfo">
                                    <span class="article-user-name">{{newMember(article.user_id)}}</span>
                                </div>
                            </div>
                        </div>
                        <v-container class="max-width">
                            <v-pagination
                            v-model="page"
                            :length="resultLength"
                            @input="resultChange"
                            ></v-pagination>
                        </v-container>
                    </div>
                    <div v-else>
                        <div class="article-count">
                            <span>{{articles.length}}/{{articles.length}}件</span>
                        </div>
                        <div class="article-item" v-for="(article, id) in articles" :key="id">
                            <nuxt-link :to="`/article/${article.id}`">
                                <!-- <img :src="article.file_path" class="article-img" v-if="article.file_path"> -->
                                <img :src="`https://${AWS}.s3.ap-northeast-1.amazonaws.com/${article.file_path}`" class="article-img" v-if="article.file_path">
                                <img src="../static/noimage.jpg" class="article-img" v-else>
                            </nuxt-link>
                            <span class="user-type-production">{{article.type}}</span>
                            <span class="ml-3">{{article.prefecture}}</span>
                            <h2 class="mt-2 mb-2">{{article.title}}</h2>
                            <p>{{article.body}}</p>
                            <div class="article-user ">
                                <nuxt-link :to="`/user/${article.user_id}`">
                                    <v-avatar size="40">
                                        <img :src="newIcon(article.user_id)">
                                    </v-avatar>
                                </nuxt-link>
                                <div class="article-userinfo">
                                    <span class="article-user-name">{{newMember(article.user_id)}}</span>
                                </div>
                            </div>
                        </div>
                        <v-container class="max-width">
                            <v-pagination
                            v-model="page"
                            :length="lastPage"
                            @input="getPosts"
                            ></v-pagination>
                        </v-container>
                    </div>
                </v-col>
            </v-row>
        </div>
        <div class="sp-search-wrapper">
            <v-btn
            icon
            to="/article/post"
            >
                <v-icon>
                    mdi-lead-pencil
                </v-icon>
            </v-btn>
            <v-btn
            icon
            @click="show=true"
            >
                <v-icon>
                    mdi-magnify
                </v-icon>
            </v-btn>
        </div>
        <transition name="confirm">
            <div class="bg" v-show="show">
                <div 
                class="bg-inner2"
                width="100%"
                >
                    <v-btn
                    icon
                    class="close-btn"
                    @click="show=false"
                    >
                        <v-icon>
                            mdi-close
                        </v-icon>
                    </v-btn>
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
                            class="mr-3 mt-7"
                            ></v-checkbox>
                            <v-checkbox
                            label="加工"
                            value="加工"
                            color="indigo"
                            v-model="showProcessing"
                            class="mt-7"
                            ></v-checkbox>
                        </div>
                        <div class="prefecture-select-wrapper">
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
                    </div>
                </div>
            </div>
        </transition>
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
            show:false,
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
            result:[],
            pageSize:5,
            page:1,		
            lastPage:1,
            resultLength:0,
            displayResult:[],
            articles:{},
            AWS:process.env.AWS_BUCKET
        }
    },
    created () {
        this.$store.dispatch('users/loadMembers');
        this.$store.dispatch('profile/loadProfiles');
        this.getPosts(this.page)
    },
    methods: {
        newMember(userId){
            const idx = this.members.findIndex(p => p.id == userId)
            if(idx < 0){
                return ''
            }
            return this.members[idx].name
        },
        newIcon(userId){
            const idx = this.profiles.findIndex(p => p.user_id == userId)
            if(idx < 0){
                return '../image.jpg'
            }
            if(!this.profiles[idx].file_path){
                return '../image.jpg'
            } else {
                let path = this.profiles[idx].file_path;
                return `https://${process.env.AWS_BUCKET}.s3.ap-northeast-1.amazonaws.com/${path}`
            }
        },
        searchType(){
            this.result = [];
            this.listShow = true;
            for(let i=0; i<this.articles.length; i++){
                let isShow = false;
                if (this.showProcessing && this.showProduction) {
                    return
                }
                if (this.showProduction && this.articles[i].type == "生産") {
                    isShow = true;
                }
                if (this.showProcessing && this.articles[i].type == "加工") {
                    isShow = true;
                }
                if (this.showPrefecture) {
                    if (this.showPrefecture == this.articles[i].prefecture) {
                        isShow = true;
                    } else {
                        isShow = false
                    }
                }
                if (isShow) {
                    this.result.push(this.articles[i]);
                }
            }
            this.showPrefecture= '';
            this.showProduction= '';
            this.showProcessing='';
            this.resultLength = Math.ceil(this.result.length/this.pageSize);
            this.displayResult = this.result.slice(this.pageSize*(this.page -1), this.pageSize*(this.page));
            return {
                1: this.resultLength,
                2: this.displayResult
            }
        },
        resetList(){
            this.listShow = false;
            this.showPrefecture= '';
            this.showProduction= '';
            this.showProcessing='';
        },
        wordSearch(){
            this.result = [];
            this.listShow = true;
            for(let i=0; i<this.articles.length; i++){
                let isShow = false;
                if (this.keyword) {
                    if (this.articles[i].body.includes(this.keyword)) {
                        isShow = true;
                    } else {
                        isShow = false
                    }
                    if (this.articles[i].title.includes(this.keyword)) {
                        isShow = true;
                    } else {
                        isShow = false
                    }
                }
                if (isShow) {
                    this.result.push(this.articles[i]);
                }
            }
            this.keyword = '';
            this.resultLength = Math.ceil(this.result.length/this.pageSize);
            this.displayResult = this.result.slice(this.pageSize*(this.page -1), this.pageSize*(this.page));
            return {
                1: this.resultLength,
                2: this.displayResult
            }
        },
        resultChange(pageNumber){
            this.displayResults = this.result.slice(this.pageSize*(pageNumber -1), this.pageSize*(pageNumber));
        },
        goPostPage(){
            const idx = this.profiles.findIndex(p => p.user_id == this.user.id)
            if(idx < 0){
                this.$store.dispatch('flashMessage/showMessage',{
                    message: '先にプロフィールを作成してください',
                    status: true
                })
            }else{
                this.$router.push({ path: '/article/post' })
            }
        },
        getPosts(page) {
            this.$axios.get('/articles', {
                params: {
                    page: parseInt(page),
                },
            }).then(res =>{
                let articles = res.data.result
                this.articles = articles.data			
                this.lastPage = articles.last_page
            })
            .catch(err => {
                console.log(err)
            })
        },
    },
    computed:{
        ...mapState('users', [
            'members',
        ]),
        ...mapState('profile', [
            'profiles',
        ]),
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
            @include sp {
                display:none;
            };
            .keyword-wrapper{
                display:flex;
                align-items: center;
            }
            .checkbox-wrapper{
                margin-bottom:10px;
                display:flex;
            }
            .post-btn-wrapper{
                border-top:2px solid #f5f5f5;
                padding-top:10px;
                margin-top:10px;
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
                    color:white;
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
.sp-search-wrapper{
    position:fixed;
    bottom:10px;
    right:10px;
    z-index:999;
    @include sp2 {
        display:none;
    };
}
.bg{
    .bg-inner2{
        width:80%;
        max-height:80%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
        background:white;
        background-blend-mode: multiply;
        padding:40px;
        text-align: center;
        font-size: 1.2rem;
            span{
                @include sp {
                    font-size:0.8rem;
                };
            }
        .checkbox-wrapper{
            margin-bottom:10px;
            display:flex;
            padding-top: 10px ;
        }
        .close-btn{
            position: absolute;
            top:10px;
            right:10px;
        }
    }
}
</style>