<?php

/**
 * 生成前台主题链接
 * @param string $url
 * @return string
 */
function skin(string $url): string
{
    return asset('themes/default/' . ltrim($url, '/')) . '?v=' . RELEASE;
}
