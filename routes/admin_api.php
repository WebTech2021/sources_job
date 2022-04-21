<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('current-balance', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'getCurrentBalance']);
        Route::get('my-info', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'myInfo'])->name('my-info');
        Route::patch('update-my-info', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'updateInfo']);
        Route::post('logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout'])->name('logout');
    });
});
