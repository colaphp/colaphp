<?php

declare(strict_types=1);

namespace App\Bundles\System\Controllers\Admin;

use App\Bundles\System\User;
use App\Http\Traits\CrudTrait;
use Flame\Database\Model;
use Flame\Http\Request;
use Flame\Http\Response;

/**
 * 管理员设置
 * Class AdminController
 */
class AdminController extends BaseController
{
    use CrudTrait;

    protected Model $model;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->model = (new User())->where('is_admin', 1);
    }

    /**
     * 删除
     */
    public function delete(Request $request): Response
    {
        $column = $request->post('column');
        $value = $request->post('value');

        $admin = session('auth_admin');
        if ($value == $admin['id']) {
            return $this->error('不能删除自己');
        }

        $this->model->where([$column => $value])->delete();

        return $this->success(0);
    }
}
