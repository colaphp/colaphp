<?php

return [
    'context_path' => '/api/',
    'rewrite_on' => true,
    'rewrite_rule' => [
        '<app>/<m>/<c>/<a>' => '<app>/<m>/<c>/<a>',
        '<app>/<m>/<c>' => '<app>/<m>/<c>/index',
        '<app>/<m>' => '<app>/<m>/index/index',
        '<app>' => '<app>/index/index/index',
    ],
    'default_app' => 'Portal',
    'default_module' => 'index',
    'default_controller' => 'Index',
    'default_action' => 'index',
];
