<?php

namespace App\Providers;

use App\Models\ModelBase;
use App\Models\ResidentialUnits;
use App\Observers\ModelObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Model::unguard(); // We deactivate the mass reassignment process
        ResidentialUnits::observe(ModelObserver::class);
    }
}
