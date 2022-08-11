<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Cola\Contracts\Middleware;
use Cola\Http\Request;
use Cola\Http\Response;

/**
 * Class RedirectIfAuthenticated
 */
class RedirectIfAuthenticated implements Middleware
{
    /**
     * @param  Request  $request
     * @param  callable  $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        if (session('?uid')) {
            if ($request->expectsJson()) {
                return json(['error' => 1, 'errors' => ['code' => 401, 'message' => 'Authenticated']]);
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
