<?php

namespace App\Manager\OAuth;

use App\Services\User\UserService;
use App\Services\Wechat\WechatService;
use EasyWeChat\OfficialAccount\Application;
use GuzzleHttp\Exception\GuzzleException;
use Overtrue\Socialite\Exceptions\AuthorizeFailedException;
use Illuminate\Http\JsonResponse;

class Wechat
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @var WechatService
     */
    private WechatService $wechatService;

    /**
     * @var Application
     */
    private Application $wechat;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->userService = new UserService();
        $this->wechatService = new WechatService();
        $this->wechat = $this->wechatService->instance();
    }

    /**
     * 生成授权链接
     * @param Request $request
     * @return Redirect
     */
    public function redirect(Request $request): Redirect
    {
        $config = config('wechat.official_account.oauth');

        $callbackUrl = url($config['callback'], $request->get())->domain(true);

        $redirectUrl = $this->wechat->oauth->scopes($config['scopes'])->redirect($callbackUrl);

        return redirect($redirectUrl);
    }

    /**
     * 授权回调
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     * @throws AuthorizeFailedException
     */
    public function callback(Request $request): JsonResponse
    {
        $code = $request->get('code');

        if (empty($code)) {
            return $this->error('Wechat authorization callback failed');
        }

        $user = $this->wechat->oauth->userFromCode($code);

        $userId = $this->userService->userInfoUpdateOrInsert($user);

        return $this->success($userId);
    }
}
