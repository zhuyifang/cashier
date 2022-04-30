import {LocalStorage} from "quasar";
import Base64 from 'base-64';

export function updateMutation(state, {id, name}) {
  id = Base64.encode(id)
  Object.assign(state, {id, name})
  LocalStorage.set('mall', state)
}
