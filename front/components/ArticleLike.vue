<template>
    <div class="article-like-wrapper">
        <v-btn
        color="red"
        icon
        v-if="liked"
        @click="unlike">
            <v-icon>
                mdi-thumb-up
            </v-icon>
        </v-btn>
        <v-btn
        icon
        v-else
        @click="like">
            <v-icon>
                mdi-thumb-up
            </v-icon>
        </v-btn>
        <span class="like-number">{{num}}</span>
    </div>
</template>

<script>
export default {
    props: ['post'],
    data(){
        return{
            num:"",
            liked:false,
        }
    },
    created() {
        this.hasfavorites();
        this.count(); 
    },
    methods: {
        like() {
            if(this.user.id === this.post.user_id){
                return
            }
            this.$axios.get(`/articles/${this.post.id}/like`)
            .then(res => {
                this.liked = true;
                this.num = res.data.count;
            })
            .catch(err => {
                console.log(err);
            });
        },
        unlike() {
            this.$axios.get(`/articles/${this.post.id}/unlike`)
            .then(res => {
                this.liked = false;
                this.num = res.data.count;
            })
            .catch(err => {
                console.log(err);
            });
        },
        count() {
            this.$axios.get('/articles/' + this.$route.params.id +'/count')
            .then(res => {
                this.num = res.data.count;
            })
            .catch(err => {
                console.log(err);
            });
        },
        hasfavorites() { 
            this.$axios.get(`/articles/${this.$route.params.id}/hasfavorites`)
            .then(res => {
                this.liked = res.data.result;
            })
            .catch(err => {
                console.log(err);
            });
        }
    }
}
</script>

<style lang="scss">
.article-like-wrapper{
    display:flex;
    align-items: center;
    .like-number{
        font-weight:bold;
        font-size:1.2rem;
    }
}
</style>