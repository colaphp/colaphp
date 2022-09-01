<?php

namespace App\Model;

use Cola\Database\Model;

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