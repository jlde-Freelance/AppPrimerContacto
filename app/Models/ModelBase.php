<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $updated_by
 * @property int $created_by
 * @property User $createdBy
 * @property User $updatedBy
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static Builder createdBy(Int $id = null)
 * @method static Builder updatedBy(Int $id = null)
 */
class ModelBase extends Model {

    /**
     * @param array $inputs
     * @return void
     */
    public function loadFillable(array $inputs): void {
        foreach ($inputs as $key => $value) {
            if ($this->isFillable($key)) $this->$key = $value;
        }
    }

    /**
     * @param $casts
     * @return string[]
     */
    public function mergeCasts($casts): array {
        return [
            'created_at' => 'date',
            'updated_at' => 'date',
        ];
    }


    /**
     * @return HasOne
     */
    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * @param Builder $query
     * @param int|null $id
     * @return void
     */
    public function scopeCreatedBy(Builder $query, int $id = null): void {
        $query->where('created_by', '=', $id ?? \Auth::user()->id);
    }

    /**
     * @return HasOne
     */
    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    /**
     * @param Builder $query
     * @param int|null $id
     * @return void
     */
    public function scopeUpdatedBy(Builder $query, int $id = null): void {
        $query->where('updated_by', '=', $id ?? \Auth::user()->id);
    }

}