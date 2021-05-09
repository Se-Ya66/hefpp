<template>
    <div>
        <Header />
        <user-profile/>
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import userprofile from '~/components/UserProfile.vue'

export default {
    middleware: 'auth',
    components:{
        Header,
        Footer,
        userprofile
    },
}
</script>

<style>

</style>