<?php

declare(strict_types=1);

namespace App\Bundles\System\Controllers\Admin;

use App\Http\Traits\CrudTrait;

/**
 * 用户管理
 * Class UserController
 */
class UserController extends BaseController
{
    use CrudTrait;

    protected Model $model;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->model = new User();
    }
}
