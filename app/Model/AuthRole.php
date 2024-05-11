<?php

declare(strict_types=1);

namespace App\Model;

use Flame\Database\Model;

/**
 * Class AuthRole
 * @package App\Model
 */
class AuthRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_role';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
