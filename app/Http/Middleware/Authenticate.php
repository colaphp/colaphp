<?php

namespace App\Http\Middleware;

use Cola\Contracts\Middleware;
use Cola\Http\Request;
use Cola\Http\Response;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
class Authenticate implements Middleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        if (!session('?uid')) {
            if ($request->expectsJson()) {
                return json(['error' => 1, 'errors' => ['code' => 401, 'message' => 'Unauthorized']]);
            } else {
                return redirect('/auth/login?callback=' . urlencode($request->fullUrl()));
            }
        }

        return $next($request);
    }
}
