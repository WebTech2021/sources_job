<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\JobSeekerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('current-balance', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'getCurrentBalance']);
        Route::get('my-info', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'myInfo'])->name('my-info');
        Route::patch('update-my-info', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'updateInfo']);
        Route::post('logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout'])->name('logout');

        Route::get('job-seeker-list',[JobSeekerController::class,'getJobSeekerList'])->name('jobSeeker.list');
        Route::put('job-seeker/{id}', [JobSeekerController::class, 'activeInactiveBlocked']);
        Route::get('/job-seeker-export', [JobSeekerController::class, 'ExportJobSeeker'])->name('jobSeeker-export');
        Route::post('/login-as-jobSeeker',[JobSeekerController::class,'loginAsJobSeeker'])->name('login.as.jobSeeker');
        Route::get('job-list',[JobSeekerController::class,'getJobList'])->name('job.list');

        Route::put('job-list/{id}', [JobSeekerController::class, 'changeJobStatus']);

        Route::apiResource('categories',CategoryController::class);
        Route::apiResource('educations',EducationController::class);
    });
});
