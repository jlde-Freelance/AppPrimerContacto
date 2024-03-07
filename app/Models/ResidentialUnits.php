<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * ResidentialUnits
 */
class ResidentialUnits extends ModelBase {

    use SoftDeletes;

    const TYPE_RESIDENTIAL_UNITS_OPTIONS = 'TYPE_RESIDENTIAL_UNITS_OPTIONS';

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'stratum_id' => 'int',
        'status' => 'int',
        'specifications' => 'array',
    ];

    /**
     * @return HasMany
     */
    public function realEstates(): HasMany {
        return $this->hasMany(RealEstate::class, 'unit_id', 'id');
    }

    /**
     * @return Collection|array
     */
    public static function getDataFormSelect($model = null): Collection|array {
        if (self::query()->count() > 30) return [];
        $query = self::query();
        $options = [];
        if (!empty($model) && isset($model->unit_id)) {
            $query = $query->whereNot('id', $model->unit_id);
            $options[] = ['id' => $model->unit_id, 'text' => $model->unit->name, 'disabled' => !(int)$model->unit->status];
        }
        return array_merge($options, $query->active()->get()->map(fn($item) => [
            'id' => $item->id,
            'text' => $item->name,
        ])->toArray());
    }

    /********************
     * FUNCTIONS SCOPES *
     ********************/

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeActive(Builder $query) {
        return $query->where('status', 1);
    }

}
