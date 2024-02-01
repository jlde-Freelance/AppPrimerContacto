<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RealEstate extends ModelBase {

    use SoftDeletes;

    /**
     * @return string
     */
    public static function getLastCode(): string {
        $lastCode = (int)(self::withTrashed()->orderByDesc('id')->value('code') ?? 0) + 1;
        return str_pad($lastCode, 5, '0', STR_PAD_LEFT);
    }

}
