<template>
    <div>
        <Header />
        <div class="message-wrapper">
            <div class="message-inner">
                <v-container>
                    <div class="message-item-wrapper">
                        <div 
                        v-for="(message, id) in messages" :key="id"
                        :class="message.send_id === user.id  ? 'send-item' : 'receive-item'"
                        >
                            <v-avatar size="40" class="ml-2 mr-2">
                                <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                            </v-avatar>
                            <div>
                                <span class="message-name">{{newMember(message.send_id)}}</span>
                                <p class="message-sentence">{{message.message}}</p>
                            </div>
                            <span class="message-date">{{message.created_at}}</span>
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
                    height="70"
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

import { mapActions, mapGetters, mapState } from 'vuex';

export default {
    components:{
        Header,
    },
    data(){
        return{
            isView:false,
            message:{
                id:this.$route.params.id,
                text:''
            }
        }
    },
    created(){
        this.judgeType
        this.$store.dispatch('message/show',this.$route.params.id);
        this.$store.dispatch('users/loadMembers');
        console.log(this.$route.params.id);
    },
    computed:{
        judgeType(){
            if(this.userid === 1){
            this.isView = true
            }
        },
        ...mapState('message', [
            'messages',
        ]),
        ...mapState('users', [
            'members',
        ]),
    },
    methods:{
        async postMessages(){
            await this.$store.dispatch('message/postMessages', this.message);
            this.message.text = '';
            this.$router.go({path: this.$router.currentRoute.path, force: true})
        },
        newMember (userId) {
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
        height:90%;
        overflow:scroll;
        @include sp {
            width:80%;
        };
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
        width:40%;
        margin:10px auto 0;
        // height:40vh;
        @include sp {
            width:80%;
        };
        .message-form{
            display: flex;
        }
    }
}
</style>