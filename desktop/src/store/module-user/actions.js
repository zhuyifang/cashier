
export function loginAction(context, {id, name}) {
  context.commit('user/loginMutation', {id, name})
}
export function logoutAction(context, {id, name}) {
  context.commit('user/logoutMutation')
}
