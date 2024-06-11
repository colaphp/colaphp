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
            'version' => '240430',
        ]);
    }
}
