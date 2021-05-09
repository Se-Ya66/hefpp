<template>
    <div class="follower-list-wrapper">
        <v-container>
            <h1>フォロワー一覧</h1>
            <v-container>
                <div 
                v-for="(follower, id) in followers" :key="id"
                class="follower-item"
                >
                    <nuxt-link :to="`/user/${follower.id}`">
                        <v-avatar size="100">
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                        </v-avatar>
                    </nuxt-link>
                    <span>{{follower.name}}</span>
                </div>
            </v-container>
        </v-container>
    </div>  
</template>

<script>
export default {
    data(){
        return{
            followers:[],
        }
    },
    created(){
        this.followerList(); 
    },
    methods:{
        followerList() {
            this.$axios.get(`/${this.$route.params.id}/followers`)
            .then(res => {
                this.followers = res.data.user;
            }).catch(function(error){
                console.log(error);
            });
        },
    }
}
</script>

<style lang="scss">
.follower-list-wrapper{
    h1{
        color:$grey;
    }
    .follower-item{
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