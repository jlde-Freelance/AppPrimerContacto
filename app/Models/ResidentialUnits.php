<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidentialUnits extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'stratum_id' => 'int',
        'status' => 'int',
        'specifications' => 'array'
    ];

}
