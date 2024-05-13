import request from '@/utils/request'
import type { IArticleCreateRequest,
IArticleResponse,
IUserQueryRequest,
IUserResponse,
IUserCreateRequest } from '@/types/manager'

// [文章管理] 创建文章接口
export const articleManagerCreateIndexService = (formData: IArticleCreateRequest): Promise<IArticleResponse> => {
    return request({
        url: '/article/manager/create/index',
        method: 'post',
        data: formData
    })
}

// [用户管理] 用户列表
export const userManagerUserIndexService = (page: number, pageSize: number, formData: IUserQueryRequest): Promise<IUserResponse> => {
    return request({
        url: '/user/manager/user/index',
        method: 'post',
        params: {page, pageSize},
        data: formData
    })
}

// [用户管理] 创建用户接口
export const userManagerUserCreateService = (formData: IUserCreateRequest): Promise<IUserResponse> => {
    return request({
        url: '/user/manager/user/create',
        method: 'post',
        data: formData
    })
}

// [控制台] 管理控制台
export const managerService = (): Promise<any> => {
    return request({
        url: '/manager',
        method: 'post'
    })
}
