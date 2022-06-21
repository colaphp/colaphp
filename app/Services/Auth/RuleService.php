<?php

namespace App\Services\Auth;

class RuleService
{
    /**
     * 获取管理资源链接
     * @param int $menu 是否仅显示菜单
     * @param int $status 显示状态
     * @return array
     */
    public function getRule(int $menu = 1, int $status = 1): array
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
                        'url' => url('admin/' . str_replace('/', '.', $v['name'])),
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
