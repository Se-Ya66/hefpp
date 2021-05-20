<template>
    <v-app-bar 
    color="white" 
    app
    class="header">
        <v-toolbar-title>
            <nuxt-link to="/main">
                <img src="../static/logo4.png">
            </nuxt-link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <span>{{user.name}}</span>
        <!-- <span>{{member.name}}</span> -->
        <v-toolbar-items>
            <v-menu 
            transition="slide-y-transition"
            min-width="200px"
            rounded
            offset-y
            open-on-click
            >
                <template #activator="{ on }">
                    <v-btn
                    v-on="on" 
                    :ripple="false"
                    large 
                    fab
                    plain
                    >
                        <v-icon large>
                            mdi-account
                        </v-icon>
                    </v-btn>
                </template>
                <v-card>
                    <v-list-item-content class="justify-center">
                        <div class="mx-auto text-center">
                            <h3>{{user.name}}</h3>
                            <v-divider class="my-3"></v-divider>
                            <v-btn depressed rounded text :to="`/user/${user.id}`"> マイページ </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn depressed rounded text :to="`/user/${user.id}/edit`"> プロフィール編集 </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn depressed rounded text :to="`/user/${user.id}/article`"> 投稿一覧 </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn depressed rounded text to="/message"> メッセージ </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn depressed rounded text @click.prevent="signOut"> ログアウト </v-btn>
                        </div>
                    </v-list-item-content>
                </v-card>
            </v-menu>
        </v-toolbar-items>
        
    </v-app-bar>
</template>

<script>
import {  mapState } from 'vuex';

export default {
    data(){
        return{
            
        }
    },
    methods: {
        signOut() {
            this.$auth.logout();
            this.$store.dispatch('flashMessage/showMessage',{
                message: 'ログアウトしました',
                status: true
            })
        }
    },
    created () {
        this.$store.dispatch('users/show',this.$route.params.id);
    },
    computed:{
        ...mapState('users', [
            'member',
        ]),
    },
}
</script>

<style lang="scss">
.header{
    line-height: 56px;
    
}
</style>