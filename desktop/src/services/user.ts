import request from '@/utils/request'
import type {  } from '@/types/user'

// [用户信息] 获取用户信息
export const userService = (): Promise<any> => {
    return request({
        url: '/user',
        method: 'get'
    })
}
