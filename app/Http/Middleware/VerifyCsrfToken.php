<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Cola\Contracts\Middleware;
use Cola\Http\Request;
use Cola\Http\Response;

/**
 * Class VerifyCsrfToken
 */
class VerifyCsrfToken implements Middleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        if (!$request->check_token()) {
            return not_found();
        }

        return $next($request);
    }
}
