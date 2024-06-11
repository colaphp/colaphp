<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

class UserSocialModel extends Model
{
    /**
     * 设置表
     */
    protected $table = 'user_socials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'provider',
        'provider_user_id',
        'access_token',
        'refresh_token',
        'expires_in',
        'token_created_at',
        'created_at',
        'updated_at',
    ];
}
