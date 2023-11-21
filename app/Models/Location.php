<?php

namespace App\Models;

/**
 * @property string $department_dane
 * @property string $department_name
 * @property string $municipality_dane
 * @property string $municipality_name
 */
class Location extends ModelBase {

    /**
     * @return array
     */
    public static function getDataFormSelect(): array {
        return self::query()->get()->collect()->groupBy('department_name')->map(fn($item) => $item->pluck('municipality_name', 'id'))->toArray();
    }

}
