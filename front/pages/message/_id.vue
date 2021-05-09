<template>
    <div>
        <Header />
        <div class="message-wrapper">
            <div class="message-inner">
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
                <p>ダミー</p><br>
            </div>
            <div class="send-form-wrapper">
                <div class="message-form">
                    <v-textarea
                    background-color="white"
                    outlined
                    />
                    <v-btn
                    class="ml-4"
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
        width:80%;
        background-color: white;
        border-radius: 5px;
        margin: 0 auto;
        height:60vh;
        overflow:scroll;
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