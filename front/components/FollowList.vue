<template>
    <div class="follow-list-wrapper">
        <v-container>
            <h1>フォロー一覧</h1>
            <v-container>
                <div 
                v-for="(following, id) in followings" :key="id" 
                class="follow-item"
                >
                    <nuxt-link :to="`/user/${following.id}`">
                        <v-avatar size="100">
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                        </v-avatar>
                    </nuxt-link>
                    <span>{{following.name}}</span>
                </div>
            </v-container>
        </v-container>
    </div>  
</template>

<script>
export default {
    props: ['userId'],
    data(){
        return{
            followings:[],
        }
    },
    created(){
        this.followList(); 
    },
    methods:{
        followList() {
            this.$axios.get(`/${this.$route.params.id}/followings`)
            .then(res => {
                this.followings = res.data.user;
            }).catch(function(error){
                console.log(error);
            });
        },
    }
}
</script>

<style lang="scss">
.follow-list-wrapper{
    h1{
        color:$grey;
    }
    .follow-item{
        border-bottom:2px solid #f5f5f5;
        padding:20px 0;
        span{
            margin-left:20px;
            font-size:1.1rem;
            font-weight:bold;
        }
    }
}
</style>