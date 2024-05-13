<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Http\Controllers\Admin\Requests\Auth\LoginMobileRequest;
use App\Http\Controllers\Admin\Responses\LoginResponse;
use Flame\Http\Response;
use Flame\Routing\Controller;
use Flame\Support\Facade\Log;
use OpenApi\Attributes as OA;
use Throwable;

class AuthController extends Controller
{
    #[OA\Post(path: '/admin/auth/login', summary: '通过手机号码登录', tags: ['登录'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: LoginMobileRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: LoginResponse::class))]
    public function login(): Response
    {
        try {
            return $this->success('mobile login');
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return $this->fail($e->getMessage());
        }
    }
}
