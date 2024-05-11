<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Flame\Contracts\Middleware;
use Flame\Http\Request;
use Flame\Http\Response;

/**
 * Class Authorization
 */
class Authorization implements Middleware
{
    /**
     * @param  Request  $request
     * @param  callable  $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        // check auth rule

        return $next($request);
    }
}
