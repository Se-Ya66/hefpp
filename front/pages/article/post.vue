<template>
    <div>
        <Header />
        <post-article />
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import postarticle from '~/components/PostArticle.vue'

export default {
    middleware: 'auth',
    components:{
        Header,
        Footer,
        postarticle
    },
}
</script>

<style lang="scss">

</style>