<script>
  import _ from 'lodash'
  import {mapState} from 'vuex'
  export default {
    computed: {
      chatConversation () {
        return _.orderBy(this.chatStore.conversation, ['created_at'], ['asc'])
      },
      ...mapState({
        chatStore: state => state.chatStore
      })
    },
    methods: {
      isReceiver (chat) {
        if (chat.receiver.id === this.chatStore.currentChatUser.id) {
          return true
        }
      }
    }
  }

</script>

<template>
  <div id="chat-widget-wrapper clearfix">
    <div v-for="chat in chatConversation" v-bind:class="{'bg-info':isReceiver(chat)}" class="conversation">
      <div class="sender-data clearfix">
        <div class="name">{{chat.sender.name}}</div>
        <div class="time">{{chat.created_at}}</div>
      </div>
      <div class="chat-body">
        {{chat.chat}}
      </div>
    </div>
  </div>
</template>

<style lang="scss">
  @import './../../assets/scss/variables.scss';
  .conversation {
    border-bottom: 1px solid $border-color;
    padding-bottom: 5px;
    margin-bottom: 10px;
    .sender-data .name {
      float: left;
      font-weight: bold;
      font-size: 1.1em;
    }
    .sender-data .time {
      font-size: 0.8em;
      float: left;
      margin-left: 10px;
      line-height: 21px;
    }
    &:last-child {
      border-bottom: none;
      padding-bottom: 6em;
    }
  }
</style>
