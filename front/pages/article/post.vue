<template>
    <div>
        <Header />
        <!-- <div class="article-post-wrapper">
            <h1>記事投稿</h1>
            <div class="form-wrapper">
                <v-text-field
                v-model="article.title"
                label="タイトル"
                />
                <v-textarea
                v-model="article.body"
                label="詳細"
                />
                <v-textarea
                v-model="article.conditions"
                label="条件"
                />
            </div>
            <v-dialog v-model="dialog">
                <template v-slot:activator="{ on }">
                    <v-btn
                    color="success"
                    class="white--text"
                    v-on="on"
                    >
                        確認する
                    </v-btn>
                </template>
                <v-card
                width="500"
                >
                    <p>{{article.title}}</p>
                    <p>{{article.body}}</p>
                    <p>{{article.conditions}}</p>
                    <v-card-actions>
                        <v-btn
                        color="success"
                        class="white--text"
                        @click="postArticles"
                        >
                            投稿
                        </v-btn>
                        <v-btn
                        color="success"
                        class="white--text"
                        @click="dialog=false"
                        >
                            キャンセル
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div> -->

        <post-article />
        <Footer />
    </div>
</template>

<script>
import Header from '~/components/Header.vue'
import Footer from '~/components/Footer.vue'
import postarticle from '~/components/PostArticle.vue'

export default {
    components:{
        Header,
        Footer,
        postarticle
    },
    data(){
        return{
            // article:{
            //     title: '',
            //     body: '',
            //     conditions:''
            // },
            // dialog:false
        }
    },
    // methods:{
    //     async postArticles(){
    //         await this.$store.dispatch('article/postArticles', this.article);
    //         this.dialog = false
    //         this.$router.push({name: 'main'});
    //     }
    // }
}
</script>

<style lang="scss">

</style>