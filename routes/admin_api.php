<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\JobSeekerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login'])->name('login');
    Route::get('job-categories', [CategoryController::class, 'jobCategories']);
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('home', [\App\Http\Controllers\Admin\HomeController::class, 'getDashboard']);
//        Route::get('current-balance', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'getCurrentBalance']);
        Route::get('my-info', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'myInfo'])->name('my-info');
        Route::patch('update-my-info', [\App\Http\Controllers\Api\Admin\AdminProfileController::class, 'updateInfo']);
        Route::post('logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout'])->name('logout');

        Route::delete('job/{id}', [JobSeekerController::class, 'destroyJob']);
        Route::put('job/{id}', [JobSeekerController::class, 'changeJobStatus']);
        Route::get('job-list',[JobSeekerController::class,'getJobList'])->name('job.list');
        Route::post('/login-as-jobSeeker',[JobSeekerController::class,'loginAsJobSeeker'])->name('login.as.jobSeeker');
        Route::get('/job-seeker-export', [JobSeekerController::class, 'ExportJobSeeker'])->name('jobSeeker-export');
        Route::put('job-seeker/{id}', [JobSeekerController::class, 'activeInactiveBlocked']);
        Route::apiResource('job-seekers',JobSeekerController::class);

        Route::apiResource('categories',CategoryController::class);
        Route::apiResource('educations',EducationController::class);
        Route::apiResource('feature-setting',\App\Http\Controllers\Admin\FeatureSettingController::class);
        Route::delete('notices-remove', [App\Http\Controllers\Admin\NoticeController::class, 'deleteNotices']);
        Route::apiResource('notices', \App\Http\Controllers\Admin\NoticeController::class);
    });
});
