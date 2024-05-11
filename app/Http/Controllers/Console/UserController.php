<?php

namespace App\Http\Controllers\Console;

use App\Http\Traits\CrudTrait;
use App\Model\User;
use Flame\Database\Model;

/**
 * 用户管理
 * Class UserController
 */
class UserController extends BaseController
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
        $this->model = new User();
    }
}
