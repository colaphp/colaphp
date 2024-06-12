<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\Admin;

use App\Support\JWTHelper;
use Flame\Http\Response;
use Flame\Support\Facade\Crypt;
use Flame\Support\Facade\DB;
use Flame\Support\Facade\Log;
use Flame\Validation\Exception\ValidationException;
use OpenApi\Attributes as OA;
use Throwable;

class DingTalkController extends BaseController
{
    #[OA\Post(path: '/api/auth/employee/dingTalk/login', summary: '钉钉内部应用免登', tags: ['员工认证'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: DingTalkLoginRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: LoginResponse::class))]
    public function login(): Response
    {
        DB::beginTransaction();
        try {
            $request = $this->requestBody();

            $v = new DingTalkLoginRequest();
            if (! $v->check($request)) {
                throw new ValidationException($v->getError());
            }

            $dingTalkBundleService = new DingTalkBundleService();
            $employee = $dingTalkBundleService->silent($request['code']);

            $JWTHelper = new JWTHelper();
            $token = $JWTHelper->createToken([
                AuthTypeEnum::Employee->value => Crypt::encryptString(json_encode($employee, JSON_UNESCAPED_UNICODE)),
            ]);

            // Data Response
            $response = new LoginResponse();
            $response->setJwt($token);

            DB::commit();

            return $this->success($response->toArray());

        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->fail($e);
            }

            Log::error($e);

            return $this->fail('钉钉登录错误');
        }
    }

    #[OA\Post(path: '/api/auth/employee/dingTalk/scan', summary: '钉钉扫码登录', tags: ['员工认证'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: DingTalkLoginRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: LoginResponse::class))]
    public function scan(): Response
    {
        DB::startTrans();
        try {
            $request = $this->requestBody();

            $v = new DingTalkLoginRequest();
            if (! $v->check($request)) {
                throw new ValidationException($v->getError());
            }

            $dingTalkBundleService = new DingTalkBundleService();
            $employee = $dingTalkBundleService->scan($request['code']);

            Log::info('$employee::'.var_export($employee, true));

            $JWTHelper = new JWTHelper();
            $token = $JWTHelper->createToken([
                AuthTypeEnum::Employee->value => Crypt::encryptString(json_encode($employee, JSON_UNESCAPED_UNICODE)),
            ]);

            // Data Response
            $response = new LoginResponse();
            $response->setJwt($token);

            DB::commit();

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->fail($e);
            }

            Log::error($e);

            return $this->fail('钉钉登录错误');
        }
    }
}
