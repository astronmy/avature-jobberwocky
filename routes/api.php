<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;


Route::prefix('v1')->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'getJobs']);
        Route::post('/', [JobController::class, 'storeJob']);
    });
    Route::prefix('alerts')->group(function () {
    });
});
