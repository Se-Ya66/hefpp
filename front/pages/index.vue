<template>
  <div class="top-wrapper">
    <v-container>
      <v-row justify="center" align="center" class="top-inner">
        <v-col  sm="12" md="6" lg="6">
          <div class="word-box">
            <img src="../static/logo2.png">
            <p>hefppは生産者と加工者をつなぎ<br>6次産業化を支援するSNSです。</p>
          </div>
        </v-col>
        <v-col cols="11" sm="6" md="6" lg="4">
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
            <p>ゲストユーザーで<span class="test-login" @click="testLogin">ログイン</span></p>
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
          this.$store.dispatch('flashMessage/showMessage',{
            message: 'ログインしました',
            status: true
          })
          this.$router.push({name : 'main'});
          return false;
        },
        async testLogin(){
          try {
            await this.$auth.login({ data: {
              email: 'test@test.co.jp',
              password: 'testtest'
            } });
          } catch(e) {
              return;
          }
          this.$store.dispatch('flashMessage/showMessage',{
            message: 'ログインしました',
            status: true
          })
          this.$router.push({name : 'main'});
          return false;
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
      @include sp {
        display:none;
      };
      img{
        width:200px;
        margin: 0 auto;
      }
      h1{
        font-size: 36px;
        text-align: center;
      }
      p{
        font-weight: 600;
        font-size: 18px;
        line-height: 2;
        letter-spacing: 0.56px;
        text-align: center;
      }
    }
    .form-wrapper{
      background-color: rgba(255,255,255,0.6);
      padding: 40px;
      text-align: center;
      img{
        opacity: 0.6;
        margin: 0 auto;
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
      .test-login{
        color: #1976d2;
        text-decoration: underline;
        cursor: pointer;
      }
    }
  }
}
</style>
