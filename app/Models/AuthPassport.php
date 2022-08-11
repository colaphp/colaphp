<?php

declare(strict_types=1);

namespace App\Model;

use Cola\Database\Model;

/**
 * Class AuthPassport
 */
class AuthPassport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_passport';

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
