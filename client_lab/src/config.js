export const apiDomain = 'http://localhost:8000/'
export const userListUrl = apiDomain + 'api/v1/user-list'
export const getUserConversationUrl = apiDomain + 'api/v1/get-user-conversation'

export const getHeader = function () {
  const tokenData = JSON.parse(window.localStorage.getItem('auth_user'))
  const header = {
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + tokenData.access_token
  }

  return header
}

export const configAuth = function () {
  const authConfig = {
    client_secret: 'fUfHVYocEzmXWVIaAi4tl8oYRgLExK2RpLmLylbh',
    client_id: 2
  }

  return authConfig
}
