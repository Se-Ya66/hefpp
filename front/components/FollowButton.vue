<template>
  <div>
    <div class="follow-count-wrapper">
        <!-- <span><span class="follow-number">{{followNum}}</span>フォロー</span>
        <span><span class="follow-number">{{followerNum}}</span>フォロワー</span> -->
        <span><span class="follow-number">{{followNum}}</span>フォロー</span>
        <span><span class="follow-number">{{followerNum}}</span>フォロワー</span>
    </div>
    <div class="user-action-wrapper">
      <div v-show="show">
        <v-btn 
        v-show="!isFollowedBy"
        @click="follow"
        icon
        >
          <v-icon>
            mdi-account-plus
          </v-icon>
        </v-btn>
        <v-btn 
        v-show="isFollowedBy"
        @click="unfollow"
        color="blue"
        icon
        >
          <v-icon>
            mdi-account-check
          </v-icon>
        </v-btn>
      </div>
      <v-btn 
      :to="`/message/${$route.params.id}`"
      v-show="show"
      class="ml-3"
      icon
      >
        <v-icon>
          mdi-email-outline
        </v-icon>
      </v-btn>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['userId'],
    data() {
      return {
        isFollowedBy: false,
        show:true,
        isView:true,
        followed:false,
        followNum:'',
        followerNum:'',
        followings:[],
        followers:[],

      }
    },
    created(){
      this.canFollow;
      this.canSend;
      this.isFollowed();
      this.count(); 
      this.followList(); 
      this.followerList(); 
    },
    computed: {
      canFollow(){
        const num = Number(this.$route.params.id);
        if(this.user.id === num){
          return this.show = false;
        }
      },
      canSend(){
        const num = Number(this.$route.params.id);
        if(this.user.id === num){
            return this.show = false;
        }
      }
    },
    methods:{
      follow() {
        this.$axios.put(`/${this.userId}/follow`)
        .then(res => {
            this.followerNum = res.data.follower_count;
            this.isFollowedBy = true;
        }).catch(function(error) {
            console.log(error);
        });
      },
      unfollow() {
        this.$axios.delete(`/${this.userId}/follow`)
        .then(res => {
            this.followerNum = res.data.follower_count;
            this.isFollowedBy = false;
        }).catch(function(error){
            console.log(error);
        });
      },
      isFollowed() { 
        this.$axios.get(`/${this.userId}/follow`)
        .then(res => {
            this.isFollowedBy = res.data.result;
            console.log(this.isFollowedBy);
        }).catch(function(error){
            console.log(error);
        });
      },
      count() {
          this.$axios.get(`/follow/${this.userId}/count`)
          .then(res => {
              this.followNum = res.data.follow_count;
              this.followerNum = res.data.follower_count;
          }).catch(function(error){
              console.log(error);
          });
      },
      followList() {
          this.$axios.get(`/${this.$route.params.id}/followings`)
          .then(res => {
              this.followings = res.data.user;
          }).catch(function(error){
              console.log(error);
          });
      },
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
  .follow-count-wrapper{
    .follow-number{
      font-weight: bold;
      font-size:1.1rem;
    }
  }
.user-action-wrapper{
  display: flex;
  align-items: flex-end;
  margin-top:5px;
}
</style>