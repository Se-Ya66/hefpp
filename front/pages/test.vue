<<template>
    <div>
        <div class="message-wrapper">
            <div class="message-inner">
                <v-container>
                    <div class="message-item-wrapper">
                        <!-- <div
                        :class="post.send_id === 1 ? 'send-item' : 'receive-item'"
                        v-for="(post, id) in posts" :key="id"
                        >
                        <v-avatar size="40" class="ml-2 mr-2">
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                        </v-avatar>
                        <div>
                            <span class="message-name">{{post.name}}</span>
                            <p class="message-sentence">{{post.message}}</p>
                        </div>
                        </div> -->
                    </div>
                </v-container>
            </div>
            <div class="send-form-wrapper">
                        <button @click="createObject">click</button>
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

export default {
    
    data(){
        return{
            isView:false,
            message:{
                id:'',
                text:''
            },
            posts:[
                {
                    id:1,
                    send_id:1,
                    receive_id:2,
                },
                {
                    id:2,
                    send_id:2,
                    receive_id:1,
                },
                {
                    id:3,
                    send_id:1,
                    receive_id:2,
                },
                {
                    id:4,
                    send_id:2,
                    receive_id:1,
                },
            ]
        }
    },
    created(){
        
    },
    computed:{
        
    },
    methods:{
        postMessages(){

        },
        createObject(){
            const result = this.posts.filter((element, index, self) => 
            self.findIndex(e => 
                e.send_id === element.send_id &&
                e.receive_id === element.receive_id
                ) === index
            );
            console.log(JSON.stringify(result, null, 2));
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