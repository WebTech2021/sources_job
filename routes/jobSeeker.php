<?php

use App\Http\Controllers\JobSeeker\Auth\ForgotPasswordController;
use App\Http\Controllers\JobSeeker\Auth\LoginController as jsLoginController;
use App\Http\Controllers\JobSeeker\Auth\RegisterController;
use App\Http\Controllers\JobSeeker\Auth\ResetPasswordController;
use App\Http\Controllers\JobSeeker\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'jobSeeker', 'as' => 'jobSeeker.'], function () {
//agent authentication system
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [jsLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [jsLoginController::class, 'login']);
    Route::post('logout', [jsLoginController::class, 'logout'])->name('logout');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
//email verification
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::group(['middleware' => ['auth:jobSeeker', 'prevent-back-history', 'OnlineActiveJobSeeker']], function () {
        Route::get('/home', [jsLoginController::class, 'index'])->name('home');
//employee profile manage routes
        Route::get('/profile', [jsLoginController::class, 'view_employee_profile'])->name('view.profile');
        Route::post('/profile/general/{id}', [jsLoginController::class, 'update_general_info'])->name('update.general');
        Route::post('/profile/password/{id}', [jsLoginController::class, 'update_password_info'])->name('update.password');

    });
});
