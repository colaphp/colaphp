<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Flame\Contracts\Middleware;
use Flame\Http\Request;
use Flame\Http\Response;

class VerifyCsrfToken implements Middleware
{
    public function process(Request $request, callable $next): Response
    {
        /*if (! $request->check_token()) {
            return not_found();
        }*/

        return $next($request);
    }
}
