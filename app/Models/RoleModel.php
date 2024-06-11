<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

class RoleModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'rules',
        'status',
        'created_at',
        'updated_at',
    ];
}
