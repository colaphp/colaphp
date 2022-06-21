<?php

function csrf_token(): string
{
    return md5('a');
}

function asset(string $url): string
{
    return '/' . $url . '?v=' . RELEASE;
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
