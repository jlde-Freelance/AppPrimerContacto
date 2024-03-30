<?php

namespace App\Models;

/**
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $observations
 */
class Client extends ModelBase {


    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        "full_name",
        "phone",
        "email",
        "observations",
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

}
