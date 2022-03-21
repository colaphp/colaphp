<?php

namespace App\Http\Middleware;

use App\Services\Auth\PassportService;
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
        $token = $request->cookie(USER_TOKEN, '');

        $passportService = new PassportService();
        $payload = $passportService->getPayloadByToken($token);

        if (!isset($payload['uid'])) {
            if ($request->expectsJson()) {
                return json(['error' => 1, 'errors' => ['code' => 401, 'message' => 'Unauthorized']]);
            } else {
                return redirect('/auth/login?callback=' . urlencode($request->fullUrl()));
            }
        }

        return $next($request);
    }
}
