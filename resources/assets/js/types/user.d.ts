export interface IArticleCreateRequest {
  title: string, // 文章标题
}

export interface IArticleUpdateRequest {
  id: number, // 文章ID
  title: string, // 文章标题
}

export interface IArticleResponse {
  id: number, // 文章编号
  title: string, // 文章标题
}

export interface ISmsCodeLoginRequest {
  mobile: string, // 手机号码
  sms_code: string, // 短信验证码
  login_code: string, // 用户登录凭证，在小程序登录时获取的 code，可通过wx.login获取
}

export interface IWechatLoginRequest {
  login_code: string, // 用户登录凭证，在小程序登录时获取的 code，可通过wx.login获取
  phone_code: string, // 手机号获取凭证，通过手机号实时验证组件
}

export interface ILoginResponse {
  jwt: string, // 用户JSON Web Token凭证
}

export interface ILoginMobileRequest {
  mobile: string, // 手机号码
  password: string, // 登录密码
  captcha: string, // 图片验证码
  uuid: string, // 图片验证码UUID参数
}

export interface IUserCreateRequest {
  name: string, // 名称
}

export interface IUserQueryRequest {
  name: string, // 名称
}

export interface IUserUpdateRequest {
  id: number, // 用户ID
  name: string, // 用户标题
}

export interface IUserResponse {
  id: number, // 编号
  name: string, // 名称
}

export interface IOptionResponse {
  name: string, // 名称
  val: number, // 值
}

