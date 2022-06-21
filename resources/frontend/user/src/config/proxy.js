export default {
    development: {
        // 开发环境接口请求
        host: import.meta.env.VITE_PUBLIC_BACKEND_URL,
        // 开发环境 cdn 路径
        cdn: '',
    },
    test: {
        // 测试环境接口地址
        host: import.meta.env.VITE_PUBLIC_BACKEND_URL,
        // 测试环境 cdn 路径
        cdn: '',
    },
    production: {
        // 正式环境接口地址
        host: import.meta.env.VITE_PUBLIC_BACKEND_URL,
        // 正式环境 cdn 路径
        cdn: '',
    },
};
