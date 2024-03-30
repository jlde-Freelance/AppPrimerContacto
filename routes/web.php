<?php

use App\Http\Controllers\ClientsControllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\ResidentialUnitsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/','login');
Route::get('/real-state/{model}/{contact?}', [RealEstateController::class, 'detail'])->name('real-estate.detail');

/*
 * Routes that require authentication
 */
Route::middleware(['auth'])->group(function () {

    /*
    * Home controller routes
    */
    Route::get('/dashboard', HomeController::class)->name('dashboard');

    /**
     * Profile controller routes
     */
    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /**
     * Residential units controller routes
     */
    Route::prefix('/residential-units')->group(function () {
        Route::match(['GET', 'POST'], '/', [ResidentialUnitsController::class, 'index'])->name('residential-units.index');
        Route::get('/create', [ResidentialUnitsController::class, 'create'])->name('residential-units.create');
        Route::get('/update/{model}', [ResidentialUnitsController::class, 'update'])->name('residential-units.update');
        Route::post('/store/{model?}', [ResidentialUnitsController::class, 'store'])->name('residential-units.store');
        Route::delete('/{model}', [ResidentialUnitsController::class, 'destroy'])->name('residential-units.destroy');

        Route::get('/select2ajax', [ResidentialUnitsController::class, 'select2Ajax'])->name('residential-units.select2ajax');
    });

    /**
     * Clients controller routes
     */
    Route::prefix('/clients')->group(function () {
        Route::match(['GET', 'POST'], '/', [ClientsControllers::class, 'index'])->name('clients.index');
        Route::get('/create', [ClientsControllers::class, 'create'])->name('clients.create');
        Route::get('/update/{model}', [ClientsControllers::class, 'update'])->name('clients.update');
        Route::post('/store/{model?}', [ClientsControllers::class, 'store'])->name('clients.store');
        Route::delete('/{model}', [ClientsControllers::class, 'destroy'])->name('clients.destroy');

//      Route::get('/select2ajax', [ResidentialUnitsController::class, 'select2Ajax'])->name('residential-units.select2ajax');

    });


    /**
     * Residential real-estate controller routes
     */
    Route::prefix('/real-estate')->group(function () {
        Route::match(['GET', 'POST'], '/', [RealEstateController::class, 'index'])->name('real-estate.index');

        Route::get('/create', [RealEstateController::class, 'create'])->name('real-estate.create');
        Route::get('/update/{model}', [RealEstateController::class, 'update'])->name('real-estate.update');
        Route::post('/store/{model?}', [RealEstateController::class, 'store'])->name('real-estate.store');
        Route::delete('/{model}', [RealEstateController::class, 'destroy'])->name('real-estate.destroy');
        Route::get('/select2ajax', [RealEstateController::class, 'ajaxGetOptions'])->name('real-estate.select2ajax');
    });


});


require __DIR__ . '/auth.php';
