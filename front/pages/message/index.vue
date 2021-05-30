<template>
    <div>
        <Header />
        <div class="message-list-wrapper">
            <h1>メッセージ中のユーザー</h1>
            <div class="message-list-inner">
            <v-container>
                <v-row>
                    <v-col 
                    v-for="(sending, id) in createList" :key="id" 
                    cols="6" sm="4" md="4" lg="4"
                    class="message-user-list"
                    >
                        <nuxt-link :to="`/message/${sending.id}`">
                            <v-avatar size="100">
                                <img :src="newIcon(sending.id)">
                            </v-avatar>
                        </nuxt-link>
                        <p>{{sending.name}}</p>
                    </v-col>
                </v-row>
                
            </v-container>
            </div>
        </div>
        <Footer />
    </div>
</template>

<script>
import { mapState } from "vuex"

import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
export default {
    components:{
        Header,
        Footer,
    },
    data(){
        return{
            sendings:[],
            receivings:[],
            list:[],
        }
    },
    created(){
        this.sendList(); 
        this.$store.dispatch('profile/loadProfiles');
    },
    methods:{
        sendList() {
            this.$axios.get(`/${this.user.id}/sendings`)
            .then(res => {
                this.sendings = res.data.send_user;
                this.receivings = res.data.receive_user;
            }).catch(function(error){
                console.log(error);
            });
        },
        newIcon(userId){
            const idx = this.profiles.findIndex(p => p.user_id == userId)
            if(idx < 0){
                return ''
            }
            if(!this.profiles[idx].file_path){
                return '/_nuxt/static/image.jpg'
                
            } else {
                return this.profiles[idx].file_path
            }
        },
    },
    computed:{
        // createList(){
        //     const newList = this.sendings.filter(function (x, i, self) { 
        //     return (self.findIndex(function (y) {
        //         return (x.name === y.name)
        //     }) === i);
        //     });
        //     return newList;
        // },
        createList(){
            this.list = this.sendings.concat(this.receivings);
            const newList = this.list.filter(function (x, i, self) { 
            return (self.findIndex(function (y) {
                return (x.name === y.name)
            }) === i);
            });
            return newList;
        },
        
        ...mapState('profile', [
            'profiles',
        ]),
    }
}
</script>

<style lang="scss">
.message-list-wrapper{
    padding:$page-pt 0;
    width:100%;
    h1{
        text-align: center;
    }
    .message-list-inner{
        width:80%;
        margin: 0 auto;
        @include sp {
            width:100%;
        };
        .message-user-list{
            text-align: center;
            p{
                padding: 10px;
                font-size:1.3rem;
            }
        }
    }
}
</style>