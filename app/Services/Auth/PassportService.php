<?php

namespace App\Services\Auth;

use App\Services\Auth\Internal\Input\LoginInput;
use App\Services\Auth\Internal\Input\MobileLoginInput;
use App\Services\Auth\Internal\Input\RegisterInput;
use Exception;
use Firebase\JWT\Key;
use Swift\Auth\Authorization;
use Swift\Auth\BearerTokenExtractor;
use Swift\Auth\JWT;
use Swift\Database\DB;
use Swift\Http\Request;
use Swift\Support\Carbon;
use Throwable;

class PassportService
{
    /**
     * 登录服务
     * @param LoginInput $loginInput
     * @return int
     * @throws Exception
     */
    public function login(LoginInput $loginInput): int
    {
        $passport = $loginInput->getUsername();
        $condition = $this->username($passport);

        $user = DB::table('ums_user')->where($condition, $passport)->where('status', 1)->first();
        if (is_null($user)) {
            throw new Exception('登录用户不存在');
        }

        if (password_verify($loginInput->getPassword(), $user->password)) {
            return $user->id;
        }

        throw new Exception('登录用户密码不正确');
    }

    /**
     * 手机号码登录服务
     * @param MobileLoginInput $mobileLoginInput
     * @return int
     * @throws Exception
     */
    public function loginByMobile(MobileLoginInput $mobileLoginInput): int
    {
        $mobile = $mobileLoginInput->getMobile();

        $user = DB::table('ums_user')->where('mobile', $mobile)->where('status', 1)->first();
        if (is_null($user)) {
            throw new Exception('登录用户不存在');
        }

        if (password_verify($mobileLoginInput->getSmsCode(), $user->remember_token)) {
            return $user->id;
        }

        throw new Exception('手机验证码不正确');
    }

    /**
     * 注册服务
     * @param RegisterInput $registerInput
     * @param string $registerType
     * @return int
     * @throws Exception
     */
    public function register(RegisterInput $registerInput, string $registerType): int
    {
        $condition = [];
        if ($registerType === 'username') {
            $condition[$registerType] = $registerInput->getUsername();
        } elseif ($registerType === 'email') {
            $condition[$registerType] = $registerInput->getEmail();
        } elseif ($registerType === 'mobile') {
            $condition[$registerType] = $registerInput->getMobile();
        }

        if (empty($condition)) {
            throw new Exception('注册类型异常');
        }

        $user = DB::table('ums_user')->where(key($condition), value($condition))->first();
        if (is_null($user)) {
            return DB::table('ums_user')->insertGetId($registerInput->toArray());
        }

        throw new Exception('注册信息已存在');
    }

    /**
     * 创建JWT参数
     * @param int $uid
     * @param int $expireIn
     * @return string
     */
    public function createToken(int $uid, int $expireIn = 7200): string
    {
        $time = Carbon::now()->timestamp;

        $payload = [
            "iss" => "http://example.org", // 签发人
            'iat' => $time, // 签发时间
            'exp' => $time + $expireIn, // 过期时间
            'uid' => $uid,
        ];

        $jwt = new JWT(config('jwt'));
        return (new Authorization($jwt))->createToken($payload);




        $time = \Illuminate\Support\Carbon::now()->timestamp;

        $config = config('jwt');
        $payload = $config['payload'];
        $payload['exp'] = $time + $expire;
        $payload['data'] = [$uid];

        return \Firebase\JWT\JWT::encode($payload, $config['key'], 'HS256');
    }

    /**
     * 根据Header头获取JWT参数
     * @param Request $request
     * @return array
     */
    public function getPayload(Request $request): array
    {
        $tokenExtractor = new BearerTokenExtractor($request);
        try {
            $jwt = new JWT(config('jwt'));
            return (new Authorization($jwt))->getPayload($tokenExtractor);
        } catch (Throwable $e) {
            return [];
        }
    }

    /**
     * 根据Token头获取JWT参数
     * @param string $token
     * @return array
     */
    public function getPayloadByToken(string $token): array
    {
        if (empty($token)) {
            return [];
        }
        try {
            $jwt = new JWT(config('jwt'));
            return (new Authorization($jwt))->getPayloadByToken($token);
        } catch (Throwable $e) {
            return [];
        }


        $decoded = (array)\Firebase\JWT\JWT::decode($token, new Key(config('jwt.key'), 'HS256'));
        return $decoded['data'] ?? [];
    }

    /**
     * 根据用户获取登录类型
     * @param string $username
     * @return string
     */
    private function username(string $username): string
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
            return 'email';
        } elseif (preg_match('/^1[3-9]\d{9}/', $username)) {
            return 'mobile';
        } else {
            return 'username';
        }
    }
}
