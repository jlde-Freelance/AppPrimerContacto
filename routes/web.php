<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


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
        Route::match(['GET', 'POST'],'/', [ResidentialUnitsController::class, 'index'])->name('residential-units.index');
        Route::match(['GET', 'POST'],'/create', [ResidentialUnitsController::class, 'create'])->name('residential-units.create');
        Route::match(['GET', 'POST'],'/update/{model}', [ResidentialUnitsController::class, 'update'])->name('residential-units.update');
        Route::match(['GET', 'POST'],'/store/{model?}', [ResidentialUnitsController::class, 'store'])->name('residential-units.store');
        Route::delete('/{model}', [ResidentialUnitsController::class, 'destroy'])->name('residential-units.destroy');

        Route::get('/select2ajax', [ResidentialUnitsController::class, 'select2Ajax'])->name('residential-units.select2ajax');
    });


});


require __DIR__ . '/auth.php';
