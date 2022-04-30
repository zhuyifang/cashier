
export function updateAction(context, {id, name}) {
  context.commit('mall/updateMutation', {id, name})
}
