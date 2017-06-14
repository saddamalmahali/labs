import Vue from 'vue'
import {userListUrl, getHeader, getUserConversationUrl, saveChatMessageUrl} from './../../config'

const state = {
  userList: {},
  currentChatUser: null,
  conversation: null,
  loading: false
}

const mutations = {
  SET_USER_LIST (state, userList) {
    state.userList = userList
  },
  SET_CURRENT_CHAT_USER (state, user) {
    state.currentChatUser = user
  },
  SET_CONVERSATION (state, conversation) {
    state.conversation = conversation
  },
  ADD_CHAT_TO_CONVERSATION (state, chat) {
    state.conversation.push(chat)
  },
  SET_LOADING (state, loading) {
    state.loading = loading
  }
}

const actions = {
  setUserList: ({ commit, state }, userList) => {
    var loading = true
    commit('SET_LOADING', loading)
    return Vue.http.get(userListUrl, {headers: getHeader()})
          .then(response => {
            if (response.status === 200) {
              commit('SET_USER_LIST', response.body.data)
              loading = false
              commit('SET_LOADING', loading)
              return response.body.data
            }
          })
  },
  setCurrentChatUser: ({ commit, state }, user) => {
    let postData = {id: user.id}
    var loading = true
    commit('SET_LOADING', loading)
    // commit('SET_CURRENT_CHAT_USER', user)
    // console.log(getHeader())
    return Vue.http.post(getUserConversationUrl, postData, {headers: getHeader()})
                .then(response => {
                  loading = false
                  commit('SET_CURRENT_CHAT_USER', user)
                  commit('SET_CONVERSATION', response.body.data)
                  commit('SET_LOADING', loading)
                })
  },
  addNewChatToConversation: ({commit}, postData) => {
    return Vue.http.post(saveChatMessageUrl, postData, {headers: getHeader()})
            .then(response => {
              commit('ADD_CHAT_TO_CONVERSATION', response.body.data)
            })
  },
  newIncomingChat: ({commit}, message) => {
    commit('ADD_CHAT_TO_CONVERSATION', message)
  }
}

export default {
  state, mutations, actions
}
