<?php

declare(strict_types=1);

namespace App\Models;

use Flame\Database\Model;

/**
 * Class Auth
 * @package App\Model
 */
class Auth extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth';

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
