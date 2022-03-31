<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
Route::group(['prefix' => 'admin'], function () {
  //admin authentication system
    Route::get('jlogon', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('jlogon', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');


    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/home', [AdminHomeController::class, 'getDashboard'])->name('admin.home');
        //Profile manage routes
        Route::get('/profile', [AdminHomeController::class, 'view_profile'])->name('view.profile');
        Route::post('/profile/{id}', [AdminHomeController::class, 'update_general'])->name('update_general');
        Route::post('/profile/password/{id}', [AdminHomeController::class, 'update_password'])->name('admin.update.password');
    });
});


