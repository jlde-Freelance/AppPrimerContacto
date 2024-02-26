<?php

namespace App\Models;

use App\Types\MasterOptionsType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * @property integer $id
 * @property string $type
 * @property string $key
 * @property string $value
 * @property integer $order
 * @method static Builder getOptionsByType(MasterOptionsType $type)
 * @method static Builder getOptionsInArray(array $inArray)
 */
class MasterOptions extends ModelBase {

    public $timestamps = false;

    protected $fillable = [
        'key',
        'type',
        'value',
        'order',
    ];

    /**
     * @param Builder $query
     * @param MasterOptionsType $type
     * @return void
     */
    public function scopeGetOptionsByType(Builder $query, MasterOptionsType $type): void {
        $query->where('type', '=', $type);
    }

    /**
     * @param Builder $query
     * @param array $inArray
     * @return void
     */
    public function scopeGetOptionsInArray(Builder $query, array $inArray): void {
        $query->whereIn('id', $inArray);
    }

    /**
     * @param MasterOptionsType|array $groupBy
     * @return array|Collection|null
     */
    public static function getDataFormSelect(MasterOptionsType|array $groupBy): array|Collection|null {
        if (is_array($groupBy)) {
            $options = [];
            foreach ($groupBy as $type) {
                $options[$type->name] = self::getDataFormSelect($type);
            }
            return $options;
        } else if ($groupBy instanceof MasterOptionsType) {
            return self::getOptionsByType($groupBy)->get()->collect()->sortBy('order')->pluck('value', 'id');
        }
        return null;
    }
}
