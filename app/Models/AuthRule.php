<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

/**
 * Class AuthRule
 * @package App\Model
 */
class AuthRule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_rule';

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
