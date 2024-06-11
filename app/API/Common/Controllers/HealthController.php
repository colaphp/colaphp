<?php

declare(strict_types=1);

namespace App\API\Common\Controllers;

use Flame\Http\Response;

class HealthController extends BaseController
{
    public function index(): Response
    {
        return json([
            'status' => 'up',
            'timezone' => date_default_timezone_get(),
            'version' => '240430',
        ]);
    }
}
