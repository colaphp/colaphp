<?php

// 手机号正则
const MOBILE_REGEX = '/^1[3-9][0-9]\d{8}$/';

/**
 * @param string $url
 * @return string
 */
function asset(string $url): string
{
    return '/' . $url . '?v=' . RELEASE;
}

/**
 * @return string
 */
function csrf_token(): string
{
    return request()->sessionId();
}

/**
 * 生成前台主题链接
 * @param string $url
 * @return string
 */
function skin(string $url): string
{
    return asset('themes/default/' . ltrim($url, '/'));
}

/**
 * @param string $url
 * @return string
 */
function url(string $url): string
{
    return $url;
}
