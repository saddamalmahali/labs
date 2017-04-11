<template lang="html">
  <div id="chat-user-list-wrapper">
    <ul class="list-group">
      <li
        class="list-group-item"
        v-bind:class="{active: userActiveStyle(user)}"
        v-on:click="changeChatUser(user)"
        v-if="user.name !== userStore.authUser.name"
        v-for="user in chatStore.userList">
        {{user.name}}
      </li>
    </ul>
  </div>
</template>

<script>
import {mapState} from 'vuex'
export default {
  computed: {
    ...mapState({
      chatStore: state => state.chatStore,
      userStore: state => state.userStore
    })
  },
  methods: {
    changeChatUser (user) {
      this.$store.dispatch('setCurrentChatUser', user)
    },
    userActiveStyle (user) {
      if (this.chatStore.currentChatUser === null) {
        console.log('null false')
        return false
      }
      if (this.chatStore.currentChatUser.id === user.id) {
        console.log('ada true')
        return true
      }
      console.log('false')
      return false
    }
  }
}
</script>

<style lang="css">
</style>
