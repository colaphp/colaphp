<?php

declare(strict_types=1);

namespace App\Http\Controllers\Console;

use App\Http\Traits\CrudTrait;
use App\Model\Admin;
use App\Model\User;
use Cola\Database\Model;
use Cola\Http\Request;
use Cola\Http\Response;

/**
 * 管理员设置
 * Class AdminController
 * @package App\Http\Controllers\Console
 */
class AdminController extends BaseController
{
    use CrudTrait;

    /**
     * @var Model
     */
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
     * @param Request $request
     * @return Response
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
