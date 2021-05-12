<template>
    <div>
        <Header />
        <div class="message-list-wrapper">
            <h1>メッセージ一覧</h1>
            <v-container>
                <div 
                v-for="(sending, id) in createList" :key="id" 
                class="send-item"
                >
                    <nuxt-link :to="`/user/${sending.id}`">
                        <v-avatar size="100">
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                        </v-avatar>
                    </nuxt-link>
                    <span>{{sending.name}}</span>
                </div>
            </v-container>
        </div>
        <Footer />
    </div>
</template>

<script>
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
        }
    },
    created(){
        this.sendList(); 
    },
    methods:{
        sendList() {
            this.$axios.get(`/${this.user.id}/sendings`)
            .then(res => {
                this.sendings = res.data.user;
            }).catch(function(error){
                console.log(error);
            });
        },
    },
    computed:{
        createList(){
            const newList = this.sendings.filter(function (x, i, self) { 
            return (self.findIndex(function (y) {
                return (x.name === y.name)
            }) === i);
            });
            return newList;
        }

    }
}
</script>

<style lang="scss">
.message-list-wrapper{
    padding:$page-pt 0;
    h1{
        text-align: center;
    }
}
</style>