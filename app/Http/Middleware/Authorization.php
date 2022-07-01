<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Cola\Contracts\Middleware;
use Cola\Http\Request;
use Cola\Http\Response;

/**
 * Class Authorization
 * @package App\Http\Middleware
 */
class Authorization implements Middleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        // check auth rule

        return $next($request);
    }
}
