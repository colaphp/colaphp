<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleModel extends Model
{
    use SoftDeletes;

    /**
     * 设置表
     */
    protected $table = 'articles';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image',
        'content',
        'status',
        'created_time',
        'updated_time',
        'deleted_time',
    ];
}
