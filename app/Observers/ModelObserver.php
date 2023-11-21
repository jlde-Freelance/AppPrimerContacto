<?php

namespace App\Observers;

use App\Models\ResidentialUnits;
use Illuminate\Database\Eloquent\Model;

class ModelObserver {

    /**
     * Handle the Model "created" event.
     * @param Model $model
     * @return void
     */
    public function creating(ResidentialUnits $model): void {
        $model->created_by = \Auth::user()->id;
    }

    /**
     * Handle the Model "update" event.
     * @param Model $model
     * @return void
     */
    public function updating(ResidentialUnits $model) {
        $model->updated_by = \Auth::user()->id;
    }

}
