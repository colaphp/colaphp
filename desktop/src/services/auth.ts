import request from '@/utils/request'
import type { ILoginMobileRequest,
ILoginResponse } from '@/types/auth'

// [登录] 通过手机号码登录
export const authLoginMobileService = (formData: ILoginMobileRequest): Promise<ILoginResponse> => {
    return request({
        url: '/auth/login/mobile',
        method: 'post',
        data: formData
    })
}
