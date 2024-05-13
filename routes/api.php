<?php

declare(strict_types=1);

use App\API\Common\Controllers\HealthController;

return [
    '/' => [HealthController::class, 'index'],
];
