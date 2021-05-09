<template>
  <div class="top-wrapper">
    <v-container>
      <v-row justify="space-around" align="center" class="top-inner">
        <v-col cols="12" sm="3" md="3" lg="5">
          <div class="word-box">
          <img src="../static/logo2.png">
          <h1>ダミーダミーダミーダミー
          </h1>
          <p>ダミーダミーダミーダミーダミーダミーダミー<br>ダミーダミーダミーダミーダミーダミーダミー</p>
        </div>
        </v-col>
        <v-col cols="12" sm="3" md="3" lg="4">
          <div class="form-wrapper">
            <img src="../static/logo4.png" >
            <v-form>
              <v-text-field
              v-model="form.email"
              label="Email"
              color="black"
              />
              <div class="error-message" v-if="errors.email">
                {{ errors.email[0] }}
              </div>
            <v-text-field
              v-model="form.password"
              label="Password"
              type="password"
              color="black"
              />
              <div class="error-message" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
              <v-btn
              color="light-green darken-1"
              class="white--text"
              @click="login"
              >
                ログイン
              </v-btn>
            </v-form>
            <p>ゲストユーザーでログイン</p>
            <p>アカウントをお持ちでないですか？
              <nuxt-link to="/register">新規登録</nuxt-link>
            </p>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  middleware: 'guest',
    data() {
      return {
        form: {
            email: '',
            password: ''
        },
      }
    },
    methods: {
        async login() {
            try {
                await this.$auth.login({ data: this.form });
            } catch(e) {
                return;
            }
            this.$router.push({name : 'main'});
        }
    }
}
</script>

<style lang="scss">
.top-wrapper{
  width:100%;
  height:100vh;
  background: url('../static/top.jpg') center center / cover no-repeat fixed;
  .top-inner{
    width:100%;
    height:100vh;
    .word-box{
      color:white;
      text-align: center;
      img{
        width:200px;
      }
      h1{
        font-size: 36px;
        text-align: left;
      }
      p{
        font-weight: 600;
        font-size: 18px;
        line-height: 2;
        letter-spacing: 0.56px;
        text-align: left;
      }
    }
    .form-wrapper{
      background-color: rgba(255,255,255,0.6);
      padding: 40px;
      text-align: center;
      img{
        opacity: 0.6;
      }
      .v-btn{
        margin: 20px;
      }
      p{
        font-size:14px;
      }
      .error-message{
        text-align: left;
        color:red;
      }
    }
  }
}
</style>
