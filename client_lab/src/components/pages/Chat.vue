<script>
  import {mapState} from 'vuex'
  import ChatUserList from './../chat/ChatUserList'
  import ChatWidget from './../chat/ChatWidget'
  export default {
    components: {
      'user-list': ChatUserList,
      'chat-widget': ChatWidget
    },
    computed: {
      ...mapState({
        chatStore: state => state.chatStore
      })
    },
    created () {
      this.$store.dispatch('setUserList')
    }
  }
</script>

<template lang="html">
  <div class="wrapper" id="chat-wrapper">
    <section class="chat-heading">
      <h1 class="page-title">Chat</h1>
    </section>
    <section class="content">
      <div class="col-md-2" id="user-list-col">
        <user-list></user-list>
      </div>
      <div class="col-md-10" id="chat-content-wrapper">
        <chat-widget></chat-widget>
      </div>
    </section>
  </div>
</template>

<style lang="css">
</style>
