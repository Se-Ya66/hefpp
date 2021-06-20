<template>
    <div>
        <Header />
        <edit-article />
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import editarticle from '~/components/EditArticle.vue'

import { mapState } from "vuex"

export default {
    middleware: 'auth',
    components:{
        Header,
        Footer,
        editarticle
    },
}
</script>

