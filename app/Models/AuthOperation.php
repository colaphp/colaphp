<?php

declare(strict_types=1);

namespace App\Model;

use Cola\Database\Model;

/**
 * Class AuthOperation
 */
class AuthOperation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_operation';

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
