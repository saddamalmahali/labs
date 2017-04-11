<template lang="html">
  <div id="login-wrapper" class="login-wrapper">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Login Aplikasi</h3>
          </div>
          <div class="panel-body">
            <form>
              <div class="form-group">
                <input type="text" v-model="username" class="form-control" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" v-model="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-sm" v-on:click="login()">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'vuex'
import {configAuth, getHeader} from '../../config.js'
export default {
  name: 'login',
  data () {
    return {
      username: '',
      password: ''
    }
  },
  computed: {
    ...mapState({
      userStore: state => state.userStore
    })
  },
  methods: {
    login () {
      var config = configAuth()
      console.log(this.$data.username)
      const postData = {
        grant_type: 'password',
        client_id: config.client_id,
        client_secret: config.client_secret,
        username: this.$data.username,
        password: this.$data.password,
        scope: ''
      }
      const authUser = {}
      this.$http.post('http://localhost:8000/oauth/token', postData)
                .then(response => {
                  if (response.status === 200) {
                    authUser.access_token = response.body.access_token
                    authUser.refresh_token = response.body.refresh_token
                    window.localStorage.setItem('auth_user', JSON.stringify(authUser))
                    this.$http.get('http://localhost:8000/api/user', {headers: getHeader()})
                          .then(response => {
                            authUser.email = response.body.email
                            authUser.name = response.body.name
                            window.localStorage.setItem('auth_user', JSON.stringify(authUser))
                            this.$store.dispatch('setUserObject', authUser)
                            this.$router.push({name: 'Dashboard'})
                          })
                  }
                }, response => {
                  console.log(response.status)
                })
    }
  }
}
</script>

<style lang="sass">
  #login-wrapper
    margin-top : 50px
</style>
