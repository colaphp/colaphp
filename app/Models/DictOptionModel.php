<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

class DictOptionModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'dict_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'created_at',
        'updated_at',
    ];
}
