<?php

namespace App\Http\Middleware;

use Swift\Contracts\Middleware;
use Swift\Http\Request;
use Swift\Http\Response;
use Swift\Support\Str;

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
        $uris = explode('/', Str::lower($request->path()));
        list($prefix, $module, $controller) = array_pad($uris, 3, null);

        if ($controller !== 'auth') {
            $session = $request->session();

            if (!$session->has('auth_' . $module)) {
                if ($request->isAjax()) {
                    return json(['error' => 1, 'errors' => ['code' => 403, 'message' => 'Forbidden']]);
                } else {
                    $callback = urlencode($request->path());
                    return redirect('/' . $module . '/auth/login?callback=' . $callback);
                }
            }
        }

        return $next($request);
    }
}