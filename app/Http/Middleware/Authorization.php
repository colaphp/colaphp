<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Flame\Contracts\Middleware;
use Flame\Http\Request;
use Flame\Http\Response;

class Authorization implements Middleware
{
    public function process(Request $request, callable $next): Response
    {
        // check auth rule

        return $next($request);
    }
}
