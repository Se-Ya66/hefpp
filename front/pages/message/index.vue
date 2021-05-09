<template>
    <div>
        <Header />
        <div class="message-list-wrapper">
            <h1>メッセージ一覧</h1>

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