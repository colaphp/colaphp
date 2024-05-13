export interface ILoginMobileRequest {
  mobile: string, // 手机号码
  password: string, // 登录密码
  captcha: string, // 图片验证码
  uuid: string, // 图片验证码UUID参数
}

export interface ILoginResponse {
  jwt: string, // 用户JSON Web Token凭证
}

