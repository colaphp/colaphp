<?php

/**
 * @param string $url
 * @return string
 */
function asset(string $url): string
{
    return '/' . $url . '?v=' . RELEASE;
}

/**
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
