<template>
    <div class="article-post-wrapper">
        <v-container>
            <h1 class="mb-5">記事投稿</h1>
            <div class="form-wrapper">
                <v-form ref="post_form">
                    <v-text-field
                    v-model="article.title"
                    outlined
                    label="タイトル"
                    :rules="[rules.required, rules.counter]"
                    maxlength="50"
                    counter
                    />
                    <v-radio-group
                    v-model="article.type"
                    row
                    :rules="[rules.required]"
                    >
                        <v-radio
                        label="生産"
                        value="生産"
                        ></v-radio>
                        <v-radio
                        label="加工"
                        value="加工"
                        ></v-radio>
                    </v-radio-group>
                    <p v-if="confirmedImage">
                        <img class="article-img" :src="confirmedImage" />
                    </p>
                    <input type="file" @change="confirmImage"  class="mb-3"/>
                    <p class="error-text">{{message}}</p>
                    <v-select
                    :items="items"
                    outlined
                    label="都道府県"
                    v-model="article.prefecture"
                    :rules="[rules.required]"
                    />
                    <v-textarea
                    v-model="article.body"
                    outlined
                    label="詳細"
                    :rules="[rules.required]"
                    counter="300"
                    />
                    <v-textarea
                    v-model="article.conditions"
                    outlined
                    label="条件"
                    :rules="[rules.required]"
                    counter="300"
                    />
                </v-form>
            </div>
        </v-container>
        <div class="edit-btn confirm-btn"
        @click="confirmDialog"
        >
            確認する
        </div>
        <transition name="confirm">
            <div class="bg" v-show="dialog">
                <div 
                class="bg-inner overflow-y-auto mx-auto my-10"
                width="100%"
                max-height="200"
                max-width="500"
                >
                    <h1 class="mb-4">投稿内容</h1>
                    <span>タイトル</span>
                    <v-container>
                        <p>{{article.title}}</p>
                    </v-container>
                    <span>種別</span>
                    <v-container>
                        <p>{{article.type}}</p>
                    </v-container>
                    <span>イメージ</span>
                    <p v-if="confirmedImage">
                        <img class="verify-img" :src="confirmedImage" />
                    </p>
                    <span>都道府県</span>
                    <v-container>
                        <p>{{article.prefecture}}</p>
                    </v-container>
                    <span>詳細</span>
                    <v-container>
                        <p>{{article.body}}</p>
                    </v-container>
                    <span>条件</span>
                    <v-container>
                        <p>{{article.conditions}}</p>
                    </v-container>
                    <p class="error-text">{{limit}}</p>
                    <div class="btn-wrapper">
                        <div
                        class="edit-btn"
                        @click="postArticles"
                        >
                            投稿
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
    </div>
</template>

<script>
import { mapState } from "vuex"

export default {
    data(){
        return{
            article:{
                title: '',
                type: '',
                prefecture: '',
                body: '',
                conditions:'',
                file:[],
            },
            dialog:false,
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
            confirmedImage: "",
            rules: {
                required: value => !!value || ' 必須項目です',
                counter: value => value.length <= 50 || '50文字以内で指定してください',
            },
            message:'',
            limit:''
        }
    },
    created(){
        this.$store.dispatch('article/loadArticles');
    },
    methods:{
        postArticles(){
            if(this.articles.length >= 10){
                this.limit = 'これ以上投稿できません。'
                return
            }
            let data = new FormData();
            data.append("title", this.article.title);
            data.append("body", this.article.body);
            data.append("file", this.article.file);
            data.append("type", this.article.type);
            data.append("prefecture", this.article.prefecture);
            data.append("conditions", this.article.conditions);
            this.$store.dispatch('article/postArticles', data)
            .then(response => {
                this.$store.dispatch('flashMessage/showMessage',{
                    message: '投稿しました',
                    status: true
                })
                this.$router.push({name: 'main'});
            }, error => {
                this.dialog = false;
                this.message = error.response.data.errors.file[0];
            })
        },
        confirmDialog(){
            if(this.$refs.post_form.validate()){
                this.dialog = true;
            }
        },
        confirmImage(e) {
            this.article.file = e.target.files[0];
            if(!this.article.file){
                this.confirmedImage = "";
                return;
            }
            if (!this.article.file.type.match("image.*")) {
                this.confirmedImage = "";
                return;
            }
            this.createImage(this.article.file);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = e => {
                this.confirmedImage = e.target.result;
            };
        },
    },
    computed:{
        ...mapState('article', [
            'articles',
        ]),
    },
}
</script>

<style lang="scss">
.article-post-wrapper{
    padding:$page-pt 0;
    h1{
        text-align: center;
    }
    .form-wrapper{
        width:80%;
        margin: 0 auto;
        .article-img{
            width:100%;
            height:300px;
            object-fit: cover;
        }
        .verify-img{
            width:100%;
            height:200px;
            object-fit: cover;
        }
    }
}
</style>