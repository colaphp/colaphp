<?php

namespace Swift\Routing\Middleware;

use Swift\Contracts\Middleware;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class ThrottleRequests
 * @package Swift\Routing\Middleware
 */
class ThrottleRequests implements Middleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        return $next($request);
    }
}
