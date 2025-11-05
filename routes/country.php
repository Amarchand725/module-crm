<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Country\Http\Controllers\CountryController;

// 🧩 Country Module Routes
Route::middleware(['web', 'auth'])
    ->prefix('countries')
    ->name('countries.')
    ->group(function () {

        // 🧱 Resource CRUD
        Route::resource('/', CountryController::class)
            ->parameters(['' => 'country']);

        // 🧩 Extra Actions (Grouped by Controller)
        Route::controller(CountryController::class)->group(function () {
            Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
            Route::post('bulk-restore', 'bulkRestore')->name('bulkRestore');
            Route::post('{id}/restore', 'restore')->name('restore');
            Route::delete('{id}/force-delete', 'forceDelete')->name('forceDelete');
        });
    });