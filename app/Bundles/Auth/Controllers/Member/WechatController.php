<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\Member;

use App\API\Member\Controllers\BaseController;
use App\Support\JWTHelper;
use Flame\Http\Response;
use Flame\Support\Facade\Crypt;
use Flame\Support\Facade\Log;
use Flame\Validation\Exception\ValidationException;
use OpenApi\Attributes as OA;
use Throwable;

class WechatController extends BaseController
{
    #[OA\Post(path: '/wechat/login', summary: '微信小程序登录', tags: ['乘客认证'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: WechatLoginRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: LoginResponse::class))]
    public function login(): Response
    {
        try {
            $request = $this->requestBody();

            // Validate Form
            $v = new WechatLoginRequest();
            if (! $v->check($request)) {
                throw new ValidationException($v->getError());
            }

            $miniAppManager = new MiniAppManager();
            $utils = $miniAppManager->getUtils();

            $authSession = $utils->codeToSession($request['login_code']);
            if (! isset($authSession['openid'])) {
                throw new CustomException('获取用户资料失败');
            }

            $phoneNumber = $miniAppManager->getPhoneNumber($request['phone_code']);
            if (! isset($phoneNumber['purePhoneNumber'])) {
                throw new CustomException('获取用户手机号码失败');
            } else {
                $authSession['mobile'] = $phoneNumber['purePhoneNumber'];
            }

            $passengerBundleService = new PassengerBundleService();
            $userAuthBundleService = new UserAuthBundleService();
            $userBundleService = new UserBundleService();

            // Login Handle
            $user = $userAuthBundleService->getUserByTypeAndIdentifier(UserAuthTypeEnum::Mobile, $authSession['mobile']);
            if (empty($user)) {
                // 自动注册 RPC
                $passenger = $passengerBundleService->createPassengerByRPC([
                    'name' => mobile_mask($authSession['mobile']),
                    'mobile' => $authSession['mobile'],
                ]);

                if (empty($passenger)) {
                    throw new CustomException('远程注册乘客失败');
                }

                // 自动新增用户
                $userEntity = $userBundleService->createUser(AuthTypeEnum::Passenger, $passenger['id'], $authSession['mobile']);
                $user = $userEntity->toArray();

                // 用户OpenId认证数据
                $openIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                if (empty($openIdAuth)) {
                    $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                }

                // 用户UnionId认证数据
                if (isset($authSession['unionid'])) {
                    $unionIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::WechatUnionId, $authSession['unionid']);
                    if (empty($unionIdAuth)) {
                        $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::WechatUnionId, $authSession['unionid']);
                    }
                }
            } else {
                $passengerId = $passengerBundleService->getPassengerIdByUserId($user['id']);
                if ($passengerId === 0) { // 补偿
                    // 自动注册 RPC
                    $passenger = $passengerBundleService->createPassengerByRPC([
                        'name' => mobile_mask($authSession['mobile']),
                        'mobile' => $authSession['mobile'],
                    ]);

                    if (empty($passenger)) {
                        throw new CustomException('乘客远程注册失败');
                    }

                    $passengerUserEntity = new PassengerUserEntity();
                    $passengerUserEntity->setPassengerId($passenger['id']);
                    $passengerUserEntity->setUserId($user['id']);

                    $passengerBundleService = new PassengerBundleService();
                    $passengerBundleService->save($passengerUserEntity->toArray());

                    $userEntity = new UserEntity();
                    $userEntity->setData($user);

                    // 用户OpenId认证数据
                    $openIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                    if (empty($openIdAuth)) {
                        $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::WechatOpenId, $authSession['openid']);
                    }

                    // 用户UnionId认证数据
                    if (isset($authSession['unionid'])) {
                        $unionIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::WechatUnionId, $authSession['unionid']);
                        if (empty($unionIdAuth)) {
                            $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::WechatUnionId, $authSession['unionid']);
                        }
                    }
                }

                $passenger = $passengerBundleService->getPassengerByRPC($passengerId);
            }

            // 认证信息
            $passenger['auth'] = $userAuthBundleService->getAuthTypeByUserId($user['id']);

            // Token
            $JWTHelper = new JWTHelper();
            $token = $JWTHelper->createToken([
                AuthTypeEnum::Passenger->value => Crypt::encryptString(json_encode($passenger, JSON_UNESCAPED_UNICODE)),
            ]);

            // Data Response
            $response = new LoginResponse();
            $response->setJwt($token);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException || $e instanceof ValidationException) {
                return $this->fail($e);
            }

            Log::error($e);

            return $this->fail('小程序登录错误');
        }
    }
}
