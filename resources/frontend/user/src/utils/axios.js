import Axios from 'axios'
import proxy from '../config/proxy'
import {ElMessage} from 'element-plus'

const env = import.meta.env.MODE || 'development';

// 如果是mock模式 就不配置host 会走本地Mock拦截
const host = env === 'mock' ? '/' : proxy[env].host;

const axios = Axios.create({
    baseURL: host,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
    timeout: 5000,
    withCredentials: true,
})

// 添加请求拦截器
axios.interceptors.request.use(function (config) {
    // 在发送请求之前做些什么
    return config;
}, function (error) {
    // 对请求错误做些什么
    return Promise.reject(error);
});

// 添加响应拦截器
axios.interceptors.response.use(function (response) {
    // 2xx 范围内的状态码都会触发该函数。
    const {data} = response;
    if (data.code === 401) { // 未认证
        const callback = encodeURIComponent(location.href)
        location.href = '/login?callback=' + callback
        return false
    }
    return data.data
}, function (error) {
    // 超出 2xx 范围的状态码都会触发该函数。
    ElMessage.error(error.message)
    return Promise.reject(error);
});

export default axios
