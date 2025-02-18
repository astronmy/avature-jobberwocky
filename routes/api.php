<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;


Route::prefix('v1')->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'getJobs']);
        Route::get('/{job_id}', [JobController::class, 'getJob']);
        Route::post('/', [JobController::class, 'storeJob']);
    });
    Route::prefix('alerts')->group(function () {
    });
});
