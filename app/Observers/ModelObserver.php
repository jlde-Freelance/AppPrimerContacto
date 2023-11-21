<?php

namespace App\Observers;

use App\Models\ModelBase;
use Illuminate\Support\Facades\Auth;

class ModelObserver {

    /**
     * Handle the Model "created" event.
     * @param ModelBase $model
     * @return void
     */
    public function creating(ModelBase $model): void {
        $model->created_by = Auth::user()->id;
    }

    /**
     * Handle the Model "update" event.
     * @param ModelBase $model
     * @return void
     */
    public function updating(ModelBase $model) {
        $model->updated_by = Auth::user()->id;
    }

}
