<?php

namespace App\Http\Middleware;

use App\Services\Auth\PassportService;
use Swift\Contracts\Middleware;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class RedirectIfAuthenticated
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated implements Middleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        $token = $request->cookie(USER_TOKEN, '');

        $passportService = new PassportService();
        $payload = $passportService->getPayloadByToken($token);

        if (isset($payload['uid'])) {
            if ($request->expectsJson()) {
                return json(['error' => 1, 'errors' => ['code' => 401, 'message' => 'Authenticated']]);
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
