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
                            <img :src="newIcon(follower.id)">
                        </v-avatar>
                    </nuxt-link>
                    <span>{{follower.name}}</span>
                </div>
            </v-container>
        </v-container>
    </div>  
</template>

<script>
import { mapState } from "vuex"

export default {
    data(){
        return{
            followers:[],
        }
    },
    created(){
        this.followerList(); 
        this.$store.dispatch('profile/loadProfiles');
    },
    methods:{
        followerList() {
            this.$axios.get(`/${this.$route.params.id}/followers`)
            .then(res => {
                this.followers = res.data.user;
            })
            .catch(err => {
                console.log(err);
            });
        },
        newIcon(userId){
            const idx = this.profiles.findIndex(p => p.user_id == userId)
            if(idx < 0){
                return '../image.jpg'
            }else{
                if(!this.profiles[idx].file_path){
                    return '../image.jpg'
                }else{
                    let path = this.profiles[idx].file_path;
                    return `https://${process.env.AWS_BUCKET}.s3.ap-northeast-1.amazonaws.com/${path}`
                }
            }
        },
    },
    computed:{
        ...mapState('profile', [
            'profiles',
        ]),
    },
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