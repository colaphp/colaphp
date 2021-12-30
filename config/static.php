<?php

return [
    'enable' => true,
    'middleware' => [ // Static file Middleware
        \App\Http\Middleware\StaticFile::class,
    ],
];