<?php

if (version_compare(PHP_VERSION, '8.0.2', '<')) {
    die('Require a PHP version ">= 8.0.2". You are running ' . PHP_VERSION . '.');
}

const APP_NAME = 'ColaPHP';
const VERSION = 'v1.0.0';
const RELEASE = '20220630';
