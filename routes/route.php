<?php

declare(strict_types=1);

use App\API\Common\Controllers\HealthController;
use Flame\Routing\Route;

Route::get('/', [HealthController::class, 'index']);
