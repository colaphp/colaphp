<?php

declare(strict_types=1);

return [
    // 签名算法
    'algorithm' => Cola\Auth\JWT::ALGORITHM_HS256,
    // 钥匙
    'key' => 'example_key',
];
