<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'mobile',
        'mobile_verified_at',
        'avatar',
        'birthday',
        'motto',
        'level',
        'money',
        'score',
        'status',
        'join_time',
        'join_ip',
        'last_time',
        'last_ip',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
