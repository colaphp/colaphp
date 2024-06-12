<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\User;

use App\Support\JWTHelper;
use Flame\Http\Response;
use Flame\Support\Facade\Crypt;
use Flame\Support\Facade\DB;
use Flame\Support\Facade\Log;
use Flame\Validation\Exception\ValidationException;
use OpenApi\Attributes as OA;
use Throwable;

class SmsController extends BaseController
{
    #[OA\Post(path: '/api/auth/passenger/sms/login', summary: '通过短信验证码登录', tags: ['乘客认证'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SmsCodeLoginRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: LoginResponse::class))]
    public function login(): Response
    {
        DB::startTrans();
        try {
            $request = $this->requestBody();

            // Validate Form
            $v = new SmsCodeLoginRequest();
            if (! $v->check($request)) {
                throw new ValidationException($v->getError());
            }

            /*$miniAppManager = new MiniAppManager();
            $utils = $miniAppManager->getUtils();

            $authSession = $utils->codeToSession($request['login_code']);
            if (! isset($authSession['openid'])) {
                throw new CustomException('获取小程序用户资料失败');
            }*/

            $smsBundleService = new SmsBundleService();
            if (! $smsBundleService->check($request['mobile'], $request['sms_code'])) {
                // throw new CustomException(SmsErrorCodeEnum::SMS_CODE_ERROR);
            }

            $passengerBundleService = new PassengerBundleService();
            $userAuthBundleService = new UserAuthBundleService();
            $userBundleService = new UserBundleService();

            // Login Handle
            $user = $userAuthBundleService->getUserByTypeAndIdentifier(UserAuthTypeEnum::Mobile, $request['mobile']);
            if (empty($user)) {
                // 自动注册 RPC
                $passenger = $passengerBundleService->createPassengerByRPC([
                    'name' => mobile_mask($request['mobile']),
                    'mobile' => $request['mobile'],
                ]);

                // 自动新增用户
                $userEntity = $userBundleService->createUser(AuthTypeEnum::Passenger, $passenger['id'], $request['mobile']);
                $user = $userEntity->toArray();

                // 用户OpenId认证数据
                $openIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                if (empty($openIdAuth)) {
                    $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                }
            } else {
                $passengerId = $passengerBundleService->getPassengerIdByUserId($user['id']);
                if ($passengerId === 0) { // 补偿
                    // 自动注册 RPC
                    $passenger = $passengerBundleService->createPassengerByRPC([
                        'name' => mobile_mask($request['mobile']),
                        'mobile' => $request['mobile'],
                    ]);

                    if (empty($passenger)) {
                        throw new CustomException('乘客远程注册失败');
                    }

                    $passengerUserEntity = new PassengerUserEntity();
                    $passengerUserEntity->setPassengerId($passenger['id']);
                    $passengerUserEntity->setUserId($user['id']);

                    $passengerBundleService = new PassengerBundleService();
                    $passengerBundleService->save($passengerUserEntity->toArray());
                }

                $userEntity = new UserEntity();
                $userEntity->setData($user);

                // 用户OpenId认证数据
                /*$openIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                if (empty($openIdAuth)) {
                    $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                }*/

                $passenger = $passengerBundleService->getPassengerByRPC($passengerId);
            }

            // 认证信息
            $passenger['auth'] = $userAuthBundleService->getAuthTypeByUserId($user['id']);

            $JWTHelper = new JWTHelper();
            $token = $JWTHelper->createToken([
                AuthTypeEnum::Passenger->value => Crypt::encryptString(json_encode($passenger, JSON_UNESCAPED_UNICODE)),
            ]);

            // Data Response
            $response = new LoginResponse();
            $response->setJwt($token);

            DB::commit();

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException || $e instanceof ValidationException) {
                return $this->fail($e);
            }

            Log::error($e);

            return $this->fail(SmsErrorCodeEnum::SMS_CODE_LOGIN_ERROR);
        }
    }
}
