<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

class UserRoleModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
