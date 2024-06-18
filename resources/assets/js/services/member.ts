import request from '@/utils/request'
import type {  } from '@/types/member.d'

// [乘客认证] 通过短信验证码登录
export const smsLoginService = (): PromiseApp\Bundles\Auth\Controllers\Member\LoginResponse => {
    return request({
        url: '/sms/login',
        method: 'post'
    })
}

// [乘客认证] 微信小程序登录
export const wechatLoginService = (): PromiseApp\Bundles\Auth\Controllers\Member\LoginResponse => {
    return request({
        url: '/wechat/login',
        method: 'post'
    })
}
