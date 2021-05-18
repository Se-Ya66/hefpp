<template>
    <div class="edit-profile-wrapper">
        <div class="edit-profile-inner ">
            <v-tabs 
            color="indigo"
            centered
            >
                <v-tab>
                    基本情報
                </v-tab>
                <v-tab>
                    プロフィール 
                </v-tab>
                <v-tab-item>
                    <!-- <v-card flat>
                    </v-card> -->
                        <v-form ref="info_form">
                            <div class="edit-profile-form">
                                <h1>名前</h1>
                                <v-container>
                                    <v-text-field 
                                    outlined
                                    v-model="myinfo.name"
                                    :rules="[rules.counter]"
                                    />
                                </v-container>
                            </div>
                            <div class="edit-profile-form">
                                <h1>メールアドレス</h1>
                                <v-container>
                                    <v-text-field 
                                    outlined
                                    v-model="myinfo.email"
                                    :rules="[rules.email]"
                                    />
                                </v-container>
                            </div>
                        </v-form>
                        <div class="edit-btn confirm-btn"
                        @click="confirmDialog2"
                        >
                            確認する
                        </div>
                        <transition name="confirm">
                            <div class="bg" v-show="dialog2">
                                <div class="bg-inner">
                                    <h1 class="mb-4">基本情報</h1>
                                    <span>名前</span>
                                    <v-container>
                                        <p>{{myinfo.name}}</p>
                                    </v-container>
                                    <span>メールアドレス</span>
                                    <v-container>
                                        <p>{{myinfo.email}}</p>
                                    </v-container>
                                    <div class="btn-wrapper">
                                        <div
                                        class="edit-btn"
                                        @click="updateInfo"
                                        >
                                            変更
                                        </div>
                                        <div
                                        class="edit-btn ml-2"
                                        @click="dialog2=false"
                                        >
                                            キャンセル
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                        <v-form ref="password_form">
                            <div class="edit-profile-form">
                                <h1>現在のパスワード</h1>
                                <v-container>
                                <v-text-field 
                                outlined
                                v-model="mypassword.current_password"
                                />
                                </v-container>
                            </div>
                            <div class="edit-profile-form">
                                <h1>新しいパスワード</h1>
                                <v-container>
                                <v-text-field 
                                outlined
                                v-model="mypassword.new_password"
                                :rules="[rules.required, rules.counter2]"
                                />
                                </v-container>
                            </div>
                        </v-form>
                        <div class="error-message" v-if="errors.password">
                            {{ errors.password[0] }}
                        </div>
                        <div class="edit-btn confirm-btn"
                        @click="updatePassword"
                        >
                            変更
                        </div>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-container >
                            <v-form ref="profile_form">
                                <div class="edit-profile-form">
                                    <h1>プロフィール写真</h1>
                                    <v-container>
                                        <v-text-field 
                                        outlined/>
                                    </v-container>
                                </div>
                                <div class="edit-profile-form">
                                    <h1>種別</h1>
                                    <v-container>
                                        <v-radio-group
                                        v-model="myprofile.type"
                                        row
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
                                </div>
                                <div class="edit-profile-form">
                                    <h1>都道府県</h1>
                                    <v-container>
                                    <v-select
                                    :items="items"
                                    outlined
                                    v-model="myprofile.prefecture"
                                    />
                                    </v-container>
                                </div>
                                <div class="edit-profile-form">
                                    <h1>URL</h1>
                                    <v-container>
                                    <v-text-field 
                                    outlined
                                    v-model="myprofile.url"
                                    />
                                    </v-container>
                                </div>
                                <div class="edit-profile-form">
                                    <h1>住所</h1>
                                    <v-container>
                                    <v-text-field 
                                    outlined
                                    v-model="myprofile.address"
                                    />
                                    </v-container>
                                </div>
                                <div class="edit-profile-form">
                                    <h1>電話番号</h1>
                                    <v-container>
                                    <v-text-field 
                                    type="tel"
                                    outlined
                                    v-model="myprofile.tel"
                                    />
                                    </v-container>
                                </div>
                                <div class="edit-profile-form edit-introduction">
                                    <h1>紹介</h1>
                                    <v-container>
                                    <v-textarea 
                                    outlined
                                    v-model="myprofile.introduction"
                                    />
                                    </v-container>
                                </div>
                            </v-form>
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
                                        <h1 class="mb-4">プロフィール</h1>
                                        <span>種別</span>
                                        <v-container>
                                            <p>{{myprofile.type}}</p>
                                        </v-container>
                                        <span>都道府県</span>
                                        <v-container>
                                            <p>{{myprofile.prefecture}}</p>
                                        </v-container>
                                        <span>URL</span>
                                        <v-container>
                                            <p>{{myprofile.url}}</p>
                                        </v-container>
                                        <span>住所</span>
                                        <v-container>
                                            <p>{{myprofile.address}}</p>
                                        </v-container>
                                        <span>電話番号</span>
                                        <v-container>
                                            <p>{{myprofile.tel}}</p>
                                        </v-container>
                                        <span>紹介文</span>
                                        <v-container>
                                            <p>{{myprofile.introduction}}</p>
                                        </v-container>
                                        <div class="btn-wrapper">
                                            <div
                                            class="edit-btn"
                                            @click="updateProfile"
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
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </div>
    </div>
</template>

<script>

import {  mapState, mapActions } from 'vuex';

export default {
    
    data(){
        return{
            myinfo:{
                name:'',
                email:'',
            },
            mypassword:{
                current_password:'',
                new_password:'',
            },
            myprofile:{
                type: '',
                prefecture: '',
                url: '',
                tel: '',
                address: '',
                introduction: '',
            },
            dialog:false,
            dialog2:false,
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
                counter: value => value.length >= 3 || '3文字以上で指定してください',
                counter2: value => value.length >= 8 || '8文字以上で指定してください',
                // counter3: value => value.length <= 300 || '300文字以内で指定してください',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || '有効なメールアドレスを指定してください'
                },
            },
        }
    },
    created(){
        this.$store.dispatch('profile/showProfile',this.user.id);
        this.$store.dispatch('users/show',this.user.id);
        Object.assign(this.myprofile,this.profile);
        Object.assign(this.myinfo,this.member);
        Object.assign(this.mypassword,this.member);
        
    },
    computed:{
        ...mapState('profile', [
            'profile',
        ]),
        ...mapState('users', [
            'member',
        ]),
        
    },
    methods:{
        ...mapActions('profile', ['update']),
        ...mapActions('profile', ['create']),
        async updateProfile () {
            if(!this.profile){
                await this.$store.dispatch('profile/create', this.myprofile)
                console.log(this.myprofile);
                this.$router.push({ path: `/user/${this.$route.params.id}` })
            }else{
                await this.$store.dispatch('profile/update', this.myprofile)
                console.log(this.myprofile);
                this.$router.push({ path: `/user/${this.$route.params.id}` })
            }
        },
        ...mapActions('users', ['update']),
            async updateInfo () {
                await this.$store.dispatch('users/update', this.myinfo)
                // this.$router.go({path: this.$router.currentRoute.path, force: true})
                this.dialog2 = false;
        },
        ...mapActions('users', ['updatePassword']),
            async updatePassword () {
                if(this.$refs.password_form.validate()){
                    await this.$store.dispatch('users/updatePassword', this.mypassword)
                    console.log(this.mypassword);
                }
        },
        confirmDialog(){
            if(this.$refs.profile_form.validate()){
                this.dialog = true;
            }
        },
        confirmDialog2(){
            if(this.$refs.info_form.validate()){
                this.dialog2 = true;
            }
        },
    }
    
}
</script>

<style lang="scss">
.edit-profile-wrapper{
    // width:80%;
    width:90%;
    margin: 0 auto;
    padding:$page-pt 0;
    .edit-profile-inner{
        h1{
            font-size:20px;
        }
        .edit-profile-form{
            width:30%;
            margin:0 auto;
            @include sp {
                width:80%;
            };
            h1{
                color:$grey;
            }
        }
        .error-message{
            text-align: center;
            color:red;
            margin-bottom:10px;
        }
        .edit-introduction{
            width:50%;
        }
        .confirm-btn{
            margin: 0 auto 20px;
        }
        .confirm-leave-active,
        .confirm-enter-active {
            transition: opacity 0.5s;
        }
        .confirm-enter {
            opacity: 0;
        }
        .confirm-enter-to {
            opacity: 1;
        }
        .confirm-leave {
            opacity: 1;
        }
        .confirm-leave-to {
            opacity: 0;
        }
    }
    
}
</style>