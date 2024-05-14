<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'permissions';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module',
        'title',
        'name',
        'parent_id',
        'component',
        'path',
        'icon',
        'frame_src',
        'hide_menu',
        'is_menu',
        'created_at',
        'updated_at',
    ];
}
