<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

class MigrationModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'migrations';

    /**
     * 主键
     */
    protected $primaryKey = 'version';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'migration_name',
        'start_time',
        'end_time',
        'breakpoint',
    ];
}
