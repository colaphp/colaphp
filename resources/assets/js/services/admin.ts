import request from '@/utils/request'
import type { IArticleCreateRequest,
IArticleResponse,
ILoginMobileRequest,
IUserQueryRequest,
IUserResponse,
IUserCreateRequest } from '@/types/admin.d'

// [文章管理] 创建文章接口
export const articleService = (formData: IArticleCreateRequest): Promise<IArticleResponse> => {
    return request({
        url: '/article',
        method: 'post',
        data: formData
    })
}

// [登录] 通过手机号码登录
export const adminAuthLoginService = (formData: ILoginMobileRequest): PromiseApp\Bundles\System\Responses\LoginResponse => {
    return request({
        url: '/admin/auth/login',
        method: 'post',
        data: formData
    })
}

// [员工认证] 钉钉内部应用免登
export const dingTalkLoginService = (): PromiseApp\Bundles\Auth\Controllers\Admin\LoginResponse => {
    return request({
        url: '/dingTalk/login',
        method: 'post'
    })
}

// [员工认证] 钉钉扫码登录
export const dingTalkScanService = (): PromiseApp\Bundles\Auth\Controllers\Admin\LoginResponse => {
    return request({
        url: '/dingTalk/scan',
        method: 'post'
    })
}

// [用户管理] 用户列表
export const userIndexService = (page: number, pageSize: number, formData: IUserQueryRequest): Promise<IUserResponse> => {
    return request({
        url: '/user/index',
        method: 'post',
        params: {page, pageSize},
        data: formData
    })
}

// [用户管理] 创建用户接口
export const userCreateService = (formData: IUserCreateRequest): Promise<IUserResponse> => {
    return request({
        url: '/user/create',
        method: 'post',
        data: formData
    })
}
