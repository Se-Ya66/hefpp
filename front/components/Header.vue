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
                    v-if="!profile.file_path"
                    v-on="on" 
                    :ripple="false"
                    large 
                    fab
                    plain
                    >
                        <v-avatar size="50"
                        >
                            <img src="../static/image.jpg">
                        </v-avatar>
                    </v-btn>
                    <v-btn
                    v-else
                    v-on="on" 
                    icon
                    large 
                    fab
                    >
                        <v-avatar size="50"
                        >
                            <img :src="profile.file_path">
                        </v-avatar>
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
        this.$store.dispatch('profile/showProfile',this.user.id);
    },
    computed:{
        ...mapState('users', [
            'member',
        ]),
        ...mapState('profile', [
            'profile',
        ]),
    },
}
</script>

<style lang="scss">
.header{
    line-height: 56px;
    
}
</style>