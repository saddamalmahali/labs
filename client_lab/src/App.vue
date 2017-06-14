<template>
  <div id="app" class="container-fluid">
    <top-menu></top-menu>
    <router-view></router-view>
  </div>
</template>

<script>
import TopMenu from './components/template/TopMenu'
import {mapState} from 'vuex'
export default {
  name: 'app',
  components: {
    TopMenu
  },
  computed: {
    ...mapState({
      userStore: state => state.userStore
    })
  },
  created () {
    const userObject = JSON.parse(window.localStorage.getItem('auth_user'))
    this.$store.dispatch('setUserObject', userObject)
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

</style>
