<template>
    <div>
        <Header />
        <edit-profile />
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import editprofile from '~/components/EditProfile.vue'

export default {
    middleware: 'auth',
    components:{
        Header,
        Footer,
        editprofile
    },
}
</script>

<style lang="scss">
.profile-edit-wrpper{
    padding:$page-pt 0;
}
</style>