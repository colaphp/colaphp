<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Flame\Contracts\Middleware;
use Flame\Http\Request;
use Flame\Http\Response;

class Authenticate implements Middleware
{
    public function process(Request $request, callable $next): Response
    {
        if (! session('?uid')) {
            if ($request->expectsJson()) {
                return json(['error' => 1, 'errors' => ['code' => 401, 'message' => 'Unauthorized']]);
            } else {
                return redirect('/auth/login?callback='.urlencode($request->fullUrl()));
            }
        }

        return $next($request);
    }
}
