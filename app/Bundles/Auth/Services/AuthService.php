<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

use App\Service\User\UserService;
use Flame\Support\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    /**
     * 返回用户数据的属性
     *
     * @param $token
     * @return array
     */
    public function auth($token = null): array
    {
        $payload = $this->getPayloadByToken($token);

        if (isset($payload['uid'])) {
            $userService = new UserService();
            $userOutput = $userService->findOne($payload['uid']);

            return $userOutput->toArray();
        }

        return [];
    }

    /**
     * 创建JWT参数
     *
     * @param  int  $uid
     * @param  int  $expire
     * @return string
     */
    public function createToken(int $uid, int $expire = 7200): string
    {
        $time = Carbon::now()->timestamp;

        $config = config('jwt');
        $payload = $config['payload'];
        $payload['exp'] = $time + $expire;
        $payload['data'] = [$uid];

        return JWT::encode($payload, $config['key'], 'HS256');
    }

    /**
     * 根据Token头获取JWT参数
     *
     * @param  string  $token
     * @return array
     */
    public function getPayloadByToken(string $token): array
    {
        $decoded = (array) JWT::decode($token, new Key(config('jwt.key'), 'HS256'));

        return $decoded['data'] ?? [];
    }

    /**
     * 获取管理资源链接
     *
     * @param  int  $menu 是否仅显示菜单
     * @param  int  $status 显示状态
     * @return array
     */
    public function getMenu(int $menu = 1, int $status = 1): array
    {
        $authRules = AuthRule::where('status', $status)
            ->where('menu', $menu)
            ->order('sort', 'asc')
            ->order('id', 'asc')
            ->get();

        $menu = [];
        foreach (collect($authRules)->toArray() as $item) {
            if ($item['parent'] === 0) {
                $filtered = collect($authRules)->filter(function ($v) use ($item) {
                    return $v['parent'] == $item['id'];
                });

                $sub = [];
                foreach ($filtered->all() as $v) {
                    $sub[] = [
                        'name' => $v['title'],
                        'url' => url('admin/'.str_replace('/', '.', $v['name'])),
                        'icon' => $v['icon'],
                    ];
                }

                $menu[] = [
                    'name' => $item['title'],
                    'url' => 'javascript:void(0);',
                    'icon' => $item['icon'],
                    'sub' => $sub,
                ];
            }
        }

        return $menu;
    }
}
