import request from '@/utils/request'
import type { ISmsSendRequest } from '@/types/common.d'

// [验证码] 获取图片验证码
export const captchaService = (): PromiseApp\Bundles\Captcha\Response\ImageCaptchaResponse => {
    return request({
        url: '/captcha',
        method: 'get'
    })
}

// [短信] 发送手机短信验证码
export const smsSendService = (formData: ISmsSendRequest): Promise<any> => {
    return request({
        url: '/sms/send',
        method: 'post',
        data: formData
    })
}
