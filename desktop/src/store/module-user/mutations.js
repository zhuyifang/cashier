import {LocalStorage} from "quasar";

export function loginMutation(state, {id, nickname, mobile, accessToken}) {
  Object.assign(state, {id, nickname, mobile, accessToken})
  LocalStorage.set('user', state)
}

export function logoutMutation(state, {id, nickname, mobile, accessToken}) {
  state.id = null
  state.nickname = null
  state.mobile = null
  state.accessToken = null
  LocalStorage.remove('user')
}
