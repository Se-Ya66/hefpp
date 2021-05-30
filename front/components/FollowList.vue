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
                            <img :src="newIcon(following.id)">
                        </v-avatar>
                    </nuxt-link>
                    <span>{{following.name}}</span>
                </div>
            </v-container>
        </v-container>
    </div>  
</template>

<script>
import { mapState } from "vuex"

export default {
    props: ['userId'],
    data(){
        return{
            followings:[],
        }
    },
    created(){
        this.followList(); 
        this.$store.dispatch('profile/loadProfiles');
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
        newIcon(userId){
            const idx = this.profiles.findIndex(p => p.user_id == userId)
            if(idx < 0){
                return ''
            }
            if(!this.profiles[idx].file_path){
                return '/_nuxt/static/image.jpg'
                
            } else {
                return this.profiles[idx].file_path
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