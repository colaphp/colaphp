<?php

namespace App\Http\Middleware;

use Swift\Contracts\Middleware;
use Swift\Http\Request;
use Swift\Http\Response;

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
        $uris = explode('/', $request->path());
        $guard = $uris[1] ?? 'user';

        $session = $request->session();

        if (!$session->has('auth_' . $guard)) {
            return json([
                'error' => 1,
                'errors' => [
                    'code' => 403,
                    'message' => 'Forbidden',
                ],
            ]);
        }

        return $next($request);
    }
}