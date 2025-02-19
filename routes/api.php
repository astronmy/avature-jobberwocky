<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SubscribersController;


Route::prefix('v1')->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'getJobs']);
        Route::get('/{job_id}', [JobController::class, 'getJob']);
        Route::delete('/{job_id}', [JobController::class, 'deleteJob']);
        Route::post('/', [JobController::class, 'storeJob']);
    });
    Route::prefix('subscribers')->group(function () {
        Route::post('/', [SubscribersController::class, 'saveSubscriber']);
    });
});
