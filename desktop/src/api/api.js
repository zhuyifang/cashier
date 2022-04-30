import urls from './urls.json'

class Api {
  constructor() {
  }

  async getCsrf() {
    let {data} = await this.$http.get(urls.csrf)
    return data
  }

  async login({mallId, username, password, captcha}) {
    let url = mallId ? `${urls.login}&mall_id=${mallId}` : urls.login
    let {data} = await this.$formHttp.post(url,
      {
        mall_id: mallId,
        user_type: mallId ? 2 : 1,
        form: {
          'username': username,
          'password': password,
          'checked': false,
          'pic_captcha': captcha
        },

      }
    )
    return data
  }

  async mainList() {
    let {data} = await this.$http.get(urls.mall.list)
    return data
  }
}

export default new Api()
