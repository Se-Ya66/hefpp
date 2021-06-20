<template>
    <div>
        <Header />
        <article-list />
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import articlelist from '~/components/ArticleList.vue'

export default {
    middleware: 'auth',
    components:{
        Header,
        Footer,
        articlelist
    },
}
</script>