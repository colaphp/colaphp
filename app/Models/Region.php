<?php

namespace App\Models;

use Swift\Database\Model;

/**
 * Class Region
 * @package App\Models
 */
class Region extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'region';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'region_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}