<?php

declare(strict_types=1);

if (! function_exists('asset')) {
    function asset(string $url): string
    {
        return url($url);
    }
}

if (! function_exists('csrf_token')) {
    /**
     * 获取Token令牌
     *
     * @param  string  $name  令牌名称
     * @param  mixed  $type  令牌生成方法
     */
    function csrf_token(string $name = '__token__', string $type = 'md5'): string
    {
        return request()->build_token($name, $type);
    }
}

if (! function_exists('token_field')) {
    /**
     * 生成令牌隐藏表单
     *
     * @param  string  $name  令牌名称
     * @param  mixed  $type  令牌生成方法
     */
    function token_field(string $name = '__token__', string $type = 'md5'): string
    {
        return '<input type="hidden" name="'.$name.'" value="'.csrf_token($name, $type).'" />';
    }
}

if (! function_exists('token_meta')) {
    /**
     * 生成令牌meta
     *
     * @param  string  $name  令牌名称
     * @param  mixed  $type  令牌生成方法
     */
    function token_meta(string $name = '__token__', string $type = 'md5'): string
    {
        return '<meta name="csrf-token" content="'.csrf_token($name, $type).'">';
    }
}

if (! function_exists('skin')) {
    function skin(string $url): string
    {
        return asset('themes/default/'.ltrim($url, '/'));
    }
}
