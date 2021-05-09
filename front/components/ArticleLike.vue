<template>
    <div>
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
        <span>いいね数：{{num}}</span>
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
    mounted () {
        this.hasfavorites();
        this.count(); 
    },
    methods: {
        like() {
            this.$axios.get(`/articles/${this.post.id}/like`)
            .then(res => {
                this.liked = true;
                this.num = res.data.count;
            }).catch(function(error) {
                console.log(error);
            });
        },
        unlike() {
            this.$axios.get(`/articles/${this.post.id}/unlike`)
            .then(res => {
                this.liked = false;
                this.num = res.data.count;
            }).catch(function(error){
                console.log(error);
            });
        },
        count() {
            this.$axios.get('/articles/' + this.post.id +'/count')
            .then(res => {
                this.num = res.data.count;
            }).catch(function(error){
                console.log(error);
            });
        },
        hasfavorites() { 
            this.$axios.get(`/articles/${this.post.id}/hasfavorites`)
            .then(res => {
                this.liked = res.data.result;
                console.log(this.liked);
            }).catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>

<style>

</style>