<template>
    <div class="register-wrapper">
      <div class="register-inner">
        <div class="form-wrapper">
          <img src="../static/logo4.png" >
          <v-form ref="register_form">
            <v-text-field
            v-model="form.name"
            label="Name"
            color="black"
            :rules="[rules.required, rules.counter]"
            />
            <v-text-field
            v-model="form.email"
            label="Email"
            color="black"
            :rules="[rules.required, rules.email]"
            />
            <v-text-field
            v-model="form.password"
            label="Password"
            color="black"
            :rules="[rules.required, rules.counter2]"
            type="password"
            />
            <v-btn
            color="light-green darken-1"
            class="white--text"
            @click="register"
            >
              登録
            </v-btn>
          </v-form>
          <nuxt-link to="/">
            <span class="link-text">
              トップへ戻る
            </span>
          </nuxt-link>
        </div>
      </div>
    </div>
</template>

<script>
import { mapState } from "vuex"

export default {
  middleware: 'guest',
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: ''
      },
      rules: {
        required: value => !!value || ' 必須項目です',
        counter: value => value.length >= 3 || '3文字以上で指定してください',
        counter2: value => value.length >= 8 || '8文字以上で指定してください',
        email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || '有効なメールアドレスを指定してください'
        },
      },
    }
  },
  created(){
    this.$store.dispatch('users/loadMembers');
  },
  methods: {
    async register() {
      if(this.members.length >= 10){
        this.form.name = ''
        this.form.email = ''
        this.form.password = ''
        this.$store.dispatch('flashMessage/showMessage',{
          message: 'これ以上登録できません',
          status: true
        })
        return
      }
      if(this.$refs.register_form.validate()){
        try {
            await this.$axios.post('/auth/register', this.form);
        } catch(e) {
            return;
        }
        this.$store.dispatch('flashMessage/showMessage',{
          message: ' 登録しました',
          status: true
        })
        this.$auth.login({data: this.form});
        this.$router.push({name: 'main'});
      }
    }
  },
  computed:{
    ...mapState('users', [
      'members',
    ]),
  }
}
</script>

<style lang="scss">
.register-wrapper{
  font-size:1.1rem;
  width:100%;
  height:100vh;
  .register-inner{
    width:60%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
    @include sp {
      width:80%;
    };
    @include tab {
      width:80%;
    };
    .form-wrapper{
      background:rgba(192, 192, 192, 0.2);
      padding: 40px;
      text-align: center;
      img{
        opacity: 0.6;
        margin:0 auto;
      }
      .v-btn{
        margin: 20px;
      }
      p{
        font-size:14px;
      }
    }

  }
}
</style>