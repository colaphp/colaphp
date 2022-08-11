<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Cola\Http\Response;

/**
 * Class IndexController
 */
class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return view('index');
    }
}
