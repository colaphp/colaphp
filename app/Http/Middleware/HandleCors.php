<?php

namespace App\Http\Middleware;

use Swift\Contracts\Middleware;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class HandleCors
 * @package App\Http\Middleware
 */
class HandleCors implements Middleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        // 如果是options请求，不处理业务
        if ($request->method() == 'OPTIONS') {
            return response('');
        }

        $response = $next($request);

        $response->withHeaders([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type,Authorization,X-Requested-With,Accept,Origin',
        ]);

        return $response;
    }
}
