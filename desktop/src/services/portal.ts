import request from '@/utils/request'
import type {  } from '@/types/portal'

// [门户信息] 获取门户信息
export const portalService = (): Promise<any> => {
    return request({
        url: '/portal',
        method: 'get'
    })
}
