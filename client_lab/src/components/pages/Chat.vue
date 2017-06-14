<script>
  import {mapState} from 'vuex'
  import ChatUserList from './../chat/ChatUserList'
  import ChatWidget from './../chat/ChatWidget'
  import ChatAddWidget from './../chat/ChatAddWidget'
  export default {
    components: {
      'user-list': ChatUserList,
      'chat-widget': ChatWidget,
      'add-chat': ChatAddWidget
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
        <div class="chat-block" id="overlay">
          <chat-widget>

          </chat-widget>
        </div>
        <div class="chatt-add">
          <add-chat></add-chat>
        </div>
      </div>
    </section>
  </div>
</template>

<style lang="css">
  #overlay {
      background: #ffffff;
      color: #666666;
  }
  
</style>
