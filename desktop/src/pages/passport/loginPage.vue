<template>
  <q-page class="login">
    <div class="row q-col-gutter-none">
      <div class="col-8 login-left text-grey-3">
        left
      </div>
      <div class="col-4 login-right q-pa-md">
        <h4 class="text-center">登录</h4>
        <q-form class="q-gutter-y-md column">
          <q-input autocomplete='username' outlined v-model="username" label="用户名"/>
          <q-input autocomplete='current-password' outlined type="password" v-model="password" label="密码"/>
         <div class="row">
            <div class="col"><span class="link">忘记密码?</span></div>
            <div class="col text-right"><span class="link">免费注册</span></div>
          </div>
          <q-btn @click="login" size="lg" color="accent" label="登录"/>
        </q-form>
      </div>
    </div>
  </q-page>
</template>

<script>
import api from '../../api/api'

export default {
  name: "loginPage",
  computed: {
    mall() {
      return this.$store.state.mall
    }
  },
  data() {
    return {
      username: 'shop-admin',
      password: '123456'
    }
  },
  created() {
    window.$$ = this
  },
  methods: {
    async login() {
      let resUser = await api.login.call(this, {
        mallId: this.mall.id,
        username: this.username,
        password: this.password
      })
      console.log(resUser)
      //
      this.$q.notify('欢迎光临')
      if (resUser.code === 0) {
        if (!this.mall.id) { // 首次登录
          this.$store.commit('user/loginMutation', {
            id: resUser.data.user.id,
            nickname: resUser.data.user.nickname,
            mobile: resUser.data.user.mobile,
            accessToken: resUser.data.user.access_token
          })
          await this.$router.replace('/bootstrap')
        }

      }

    }
  }
}
</script>

<style lang="scss" scoped>
.login {
  background: #222131;
}

.login-left {
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-right {
  background-color: #fff;
  height: 100vh;

  .link {
    cursor: pointer;
    color: #4c4c4c;

    &:hover {
      color: #0f0f0f;
    }
  }

}
</style>

user_type=1&mall_id=&_csrf=6W46QvWa_6VyUPsacAZwzkUaNXtU0D7Jm0FRnkHO3RWxXRcvt9i29ABpqlkJaj-CKyxFSx_mf4vhcxjGJY_pIg%3D%3D


mall_id=&user_type=1&_csrf=PvhOwl1TtMTBVYFFm6PDZvMOOt0MulKul4mQ061tcABOjxeXbjfZvYk_8Hf94IFUiltvnluPZOXd-fWmnQkyMw%3D%3D
