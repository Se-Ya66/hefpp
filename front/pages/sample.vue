<template>
  <div>
    <Header />
    <div class="main-wrapper">
      <v-row justify="center" class="main-inner">
        <v-col cols="2">
          <div class="control-card">
            <span>検索条件</span>
            <v-text-field label="キーワードで検索" color="indigo" />
            <div class="checkbox-wrapper mb-4">
              <span>種別</span>
              <v-checkbox
              label="生産"
              color="indigo"
              value="red"
              hide-details
            ></v-checkbox>
            <v-checkbox
              label="加工"
              color="indigo"
              value="red"
              hide-details
            ></v-checkbox>
            </div>
            <div class="checkbox-wrapper">
              <span class="mb-2">地域</span>
              <v-autocomplete
              :items="items"
              color="indigo"
              outlined
              small-chips
              deletable-chips
              clearable
              multiple
            ></v-autocomplete>
            </div>
          </div>
        </v-col>
        <v-col cols="6">
          <div class="recruit-count">
            <!-- <span>20件</span> -->
            <span>{{articles.length}}/{{articles.length}}件</span>
          </div>
          <div class="recruit-item" v-for="( post, id) in articles" :key="id">
            <img :src="post.path" class="recruit-img" v-if="post.path">
            <img src="../static/noimage.jpg" class="recruit-img" v-else>
            <h2 class="mt-2 mb-2">{{ post.title}}</h2>
            <p>{{ post.body}}</p>
            <div class="recruit-userinfo">
                <span >株式会社ケイアンドカンパニー</span>
                <div>愛知</div>
            </div>
          </div>
          <v-pagination
          v-model="page"
          :length="lastPage"
          @input="getPosts"
          ></v-pagination>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import {  mapState, mapActions } from 'vuex';
export default {
  data(){
    return{
      myArticle:{
          title:this.article.title,
          body:this.article.body,
          conditions:this.article.conditions,
          type:this.article.type,
          prefecture:this.article.prefecture,
      },
    }
  },
  created () {
    this.$store.dispatch('article/show',this.$route.params.id);
  },
  computed:{
    ...mapState('article', [
      'article',
    ]),
  },
}
</script>

<style lang="scss">
.main-wrapper{
  padding-top:80px;
  width:100%;
  height:100vh;
  .main-inner{
    width:100%;
    .recruit-count{
      border-bottom:2px solid #f5f5f5;
      padding-bottom:10px;
      max-width:550px;
    }
    .control-card{
      height:500px;
      width:15%;
      position: fixed;
      padding:20px 0;
      
    }
    .recruit-item{
      max-width:550px;
      border-bottom:2px solid #f5f5f5;
      padding-top:20px;
      padding-bottom:20px;
      .recruit-img{
        width:100%;
        height:220px;
        object-fit: cover;
      }
      .recruit-user{
        display: flex;
        .recruit-userinfo{
          margin-left:10px;
        }
      }
    }
  }
}
</style>