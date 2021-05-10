<template>
    <div>
        <Header />
        <div class="message-wrapper">
            <div class="message-inner">
                <v-container>
                    <div class="message-item-wrapper">
                        <div 
                        class="send-item"
                        v-for="(send, id) in sends" :key="id"
                        >
                        <v-avatar size="40" class="ml-2 mr-2">
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                        </v-avatar>
                        <div>
                            <span class="message-name">{{send.name}}</span>
                            <p class="message-sentence">{{send.message}}</p>
                        </div>
                        <span class="message-date">05/08/16:00</span>
                        </div>
                    </div>
                </v-container>
            </div>
            <div class="send-form-wrapper">
                <div class="message-form">
                    <v-textarea
                    background-color="white"
                    outlined
                    v-model="message.text"
                    />
                    <v-btn
                    class="ml-4"
                    @click="postMessages"
                    >
                        送信
                    </v-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
export default {
    components:{
        Header,
    },
    data(){
        return{
            sends:[
                {
                    id:1,
                    userid:1,
                    message:'ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー',
                    name:'seiya'
                },
                {
                    id:2,
                    userid:2,
                    message:'ダミーダミーダミー',
                    name:'user'
                },
                {
                    id:3,
                    userid:2,
                    message:'ダミーダミーダミー',
                    name:'user'
                },
                
                {
                    id:4,
                    userid:1,
                    message:'ダミーダミーダミー',
                    name:'seiya'
                },
                {
                    id:5,
                    userid:2,
                    message:'ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー',
                    name:'user'
                },
                {
                    id:6,
                    userid:1,
                    message:'ダミーダミーダミー',
                    name:'seiya'
                },
            ],
            isView:false,
            message:{
                id:this.$route.params.id,
                text:''
            }
        }
    },
    created(){
        this.judgeType
    },
    computed:{
        judgeType(){
            if(this.userid === 1){
            this.isView = true
            }
        }

    },
    methods:{
        async postMessages(){
            await this.$store.dispatch('message/postMessages', this.message);
            this.message.text = '';
        }
    }
}
</script>

<style lang="scss">
.message-wrapper{
    padding:$page-pt 0;
    width:100%;
    height:100vh;
    background-color: grey;
    position:relative;
    .message-inner{
        width:50%;
        background-color: white;
        border-radius: 5px;
        margin: 0 auto;
        height:60vh;
        overflow:scroll;
        .message-item-wrapper{
        .send-item,
        .receive-item
        {
            display: flex;
            align-items: flex-end;
            width:100%;
            .message-name{
                color:$grey;
                font-weight:bold;
            }
            .message-sentence{
                padding: 9px 12px;
                border-radius: 18px;
                max-width: 336px;
                font-size: 14px;
                line-height: 18px;
                color: #24282A;
                background-color: #f9f9f9;
                word-break: break-all;
            }
            .message-date{
                font-size:0.6rem;
            }
        }
        .send-item{
            flex-direction: row-reverse;
        }
        
        }
        
    }
    .send-form-wrapper{
        // position:absolute;
        // bottom:0;
        width:40%;
        // right:0;
        // left:0;
        // height:10vh;
        margin:10px auto 0;
        .message-form{
            display: flex;
        }
    }
}
</style>