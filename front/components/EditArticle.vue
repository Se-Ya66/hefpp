<template>
    <div class="article-edit-wrapper">
        <v-container>
            <div class="article-edit-inner">
                <v-form ref="article_form">
                    <img :src="article.file_path" class="article-img" v-if="article.file_path">
                    <p v-if="confirmedImage">
                        <img class="article-img" :src="confirmedImage" />
                    </p>
                    <input class="mb-3" type="file" @change="confirmImage" />
                    <div class="edit-btn confirm-btn"
                    @click="updateImage"
                    >
                        写真を変更
                    </div>
                    <h2>タイトル</h2>
                    <v-container>
                        <v-text-field
                        outlined
                        v-model="myarticle.title"
                        :rules="[rules.required, rules.counter]"
                        maxlength="50"
                        counter
                        />
                    </v-container>
                    <h2>種別</h2>
                    <v-container>
                        <v-radio-group
                        v-model="myarticle.type"
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
                    </v-container>
                    <h2>都道府県</h2>
                    <v-container>
                        <v-select
                        :items="items"
                        outlined
                        label="都道府県"
                        v-model="myarticle.prefecture"
                        :rules="[rules.required]"
                        />
                    </v-container>
                    <h2>詳細</h2>
                    <v-container>
                        <v-textarea 
                        outlined
                        v-model="myarticle.body"
                        :rules="[rules.required, rules.counter2]"
                        maxlength="300"
                        counter
                        />
                    </v-container>
                    <h2>条件</h2>
                    <v-container>
                        <v-textarea 
                        type="tel"
                        outlined
                        v-model="myarticle.conditions"
                        :rules="[rules.required, rules.counter2]"
                        maxlength="300"
                        counter
                        />
                    </v-container>
                </v-form>
            </div>
            <div class="edit-btn confirm-btn"
            @click="confirmArticle"
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
                            <p>{{myarticle.title}}</p>
                        </v-container>
                        <span>種別</span>
                        <v-container>
                            <p>{{myarticle.type}}</p>
                        </v-container>
                        <span>都道府県</span>
                        <v-container>
                            <p>{{myarticle.prefecture}}</p>
                        </v-container>
                        <span>詳細</span>
                        <v-container>
                            <p>{{myarticle.body}}</p>
                        </v-container>
                        <span>条件</span>
                        <v-container>
                            <p>{{myarticle.conditions}}</p>
                        </v-container>
                        <div class="btn-wrapper">
                            <div
                            class="edit-btn"
                            @click="updateArticle"
                            >
                                変更
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
        </v-container>
    </div>
</template>

<script>

import {  mapState, mapActions } from 'vuex';

export default {
    data(){
        return{
            myarticle:{
                title:'',
                body:'',
                conditions:'',
                type:'',
                prefecture:'',
            },
            confirmedImage: "",
            file:'',
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
            rules: {
                required: value => !!value || ' 必須項目です',
                counter: value => value.length <= 50 || '50文字以内で指定してください',
                counter2: value => value.length <= 300 || '300文字以内で指定してください',
            },
        }
    },
    created () {
        this.$store.dispatch('article/show',this.$route.params.id);
        Object.assign(this.myarticle,this.article);
    },
    methods: {
        ...mapActions('article', ['update']),
        async updateArticle () {
            await this.$store.dispatch('article/update', {articleId:this.$route.params.id, article:this.myarticle})
            this.$router.push({ path: `/article/${this.$route.params.id}` })
        },
        confirmArticle(){
            if(this.$refs.article_form.validate()){
                this.dialog = true;
            }
        },
        updateImage(){
                let data = new FormData();
                    data.append("file", this.file);
            this.$axios
                .post(`/${this.$route.params.id}/article/image`, data)
                .then(response => {
                    this.file = "";
                })
                .catch(err => {
                    console.log(err);
                });
                this.$router.push({ path: `/article/${this.$route.params.id}` })
                this.$router.go({path: this.$router.currentRoute.path, force: true})

            
        },
        confirmImage(e) {
            this.file = e.target.files[0];
            if (!this.file.type.match("image.*")) {
                this.confirmedImage = "";
                return;
            }
            this.createImage(this.file);
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
            'article',
        ]),
    },
}
</script>

<style lang="scss">
.article-edit-wrapper{
    width:100%;
    margin:0 auto;
    padding:$page-pt 0;
    .article-img{
        width:100%;
        height:400px;
        object-fit: cover;
    }
    .article-edit-inner{
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
</style>