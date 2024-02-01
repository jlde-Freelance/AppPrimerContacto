<?php

namespace App\Models;

use Illuminate\Support\Collection;

/**
 * @property string $department_dane
 * @property string $department_name
 * @property string $municipality_dane
 * @property string $municipality_name
 */
class Location extends ModelBase {

    const TYPE_LOCATION_OPTIONS = 'TYPE_LOCATION_OPTIONS';

    /**
     * @return Collection
     */
    public static function getDataFormSelect(): Collection {
        return self::query()->get()->collect()->groupBy('department_name')->map(fn($item) => $item->pluck('municipality_name', 'id'));
    }

}
