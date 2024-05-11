<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Flame\Contracts\Middleware;
use Flame\Http\Request;
use Flame\Http\Response;

/**
 * Class StaticFile
 */
class StaticFile implements Middleware
{
    /**
     * @param  Request  $request
     * @param  callable  $next
     * @return Response
     */
    public function process(Request $request, callable $next): Response
    {
        // 禁止访问.开头的隐藏文件
        if (str_contains($request->path(), '/.')) {
            return response('<h1>403 forbidden</h1>', 403);
        }

        /** @var Response $response */
        $response = $next($request);

        // Add cross domain HTTP header
        /*$response->withHeaders([
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Credentials' => 'true',
        ]);*/

        return $response;
    }
}
