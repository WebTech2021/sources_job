<?php

use App\Http\Controllers\JobSeeker\Auth\ForgotPasswordController;
use App\Http\Controllers\JobSeeker\Auth\LoginController as jsLoginController;
use App\Http\Controllers\JobSeeker\Auth\RegisterController;
use App\Http\Controllers\JobSeeker\Auth\ResetPasswordController;
use App\Http\Controllers\JobSeeker\Auth\VerificationController;
use App\Http\Controllers\JobSeeker\CareerAndApplicationInformationController;
use App\Http\Controllers\JobSeeker\HomeController as JsHomeController;
use App\Http\Controllers\JobSeeker\JsJobsController;
use App\Http\Controllers\JobSeeker\JSEducationController;
use App\Http\Controllers\JobSeeker\JSExperienceController;
use App\Http\Controllers\JobSeeker\JSPortfolioController;
use App\Http\Controllers\JobSeeker\KeyFeatureController;
use App\Http\Controllers\JobSeeker\ProfileController;
use App\Http\Controllers\JobSeeker\ReferenceController;
use App\Http\Controllers\JobSeeker\skillController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'jobSeeker.'], function () {
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
    Route::get('upazila/get_by_district', [JsHomeController::class, 'get_by_district'])->name('upazila.get_by_district');
    Route::get('district/get_by_divison', [JsHomeController::class, 'get_by_division'])->name('districts.get_by_division');

//email verification
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::group(['middleware' => ['auth:jobSeeker', 'prevent-back-history', 'OnlineActiveJobSeeker']], function () {
        Route::get('/', [JsHomeController::class, 'index'])->name('home');
        //Job seeker profile manage routes
        Route::get('/profile', [JsHomeController::class, 'view_jobSeeker_profile'])->name('view.profile');
        Route::post('/profile/general/{id}', [JsHomeController::class, 'update_general_info'])->name('update.general');
        Route::post('/profile/password/{id}', [JsHomeController::class, 'update_password_info'])->name('update.password');

        Route::get('/profile/edit', [ProfileController::class, 'edit_profile'])->name('profileInfo.edit');
        Route::put('/profile/update/{id}', [ProfileController::class, 'update_profile'])->name('profile.update');
        Route::get('/profile/preview', [ProfileController::class, 'cv_preview'])->name('profileInfo.preview');

        //Job seeker education route
        Route::resource('/education', JSEducationController::class);
        //Job seeker experience route
        Route::resource('/experience', JSExperienceController::class);
        //Job seeker reference route
        Route::resource('/reference', ReferenceController::class);

        //Career Info route
        Route::get('/career/info/create', [CareerAndApplicationInformationController::class, 'getCareerInfo'])->name('career-info');
        Route::post('/career/info/store', [CareerAndApplicationInformationController::class, 'storeInfo'])->name('info-store');
        Route::get('/career/info/edit', [CareerAndApplicationInformationController::class, 'editInfo'])->name('info-edit');
        Route::put('/career/info/{id}/update', [CareerAndApplicationInformationController::class, 'update_career_info'])->name('update.career-info');

//        //jobSeeker Notification
//        Route::get('/notification', [NotificationController::class,  'index'])->name('notification.index');
//        Route::get('/mark-as-read/[{id},{r_name},{product_id}]', [NotificationController::class, 'mark_as_read'])->name('mark-as-read');
//        Route::post('/delete-notification', [NotificationController::class, 'deleteNotification'])->name('delete.notification');

        //jobSeeker portfolio
        Route::resource('/portfolio', JSPortfolioController::class);
        //job Seeker JOBS
        Route::get('/jobs-list', [JsJobsController::class, 'get_job_list'])->name('jobs.list');
        Route::get('/job/details/{id}', [JsJobsController::class, 'job_details'])->name('jobs.details');
        Route::post('/job/apply/{id}', [JsJobsController::class, 'apply'])->name('job.apply');
        Route::get('/get-short-list', [JsJobsController::class, 'getShortlist'])->name('application.status');

        Route::get('/key-features', [KeyFeatureController::class, 'KeyFeature'])->name('key.features');
        Route::post('/key-features/{id?}', [KeyFeatureController::class, 'create_KeyFeature'])->name('key_features.create');

        Route::get('/skill',[skillController::class,'createSkill'])->name('skill.create');
        Route::post('/skill/store',[skillController::class,'storeSkill'])->name('skill.store');
        Route::delete('/skill/delete{id}',[skillController::class,'destroy'])->name('skill.destroy');
        Route::get('invite/list',[JsJobsController::class,'inviteList'])->name('invite.list');
        Route::put('invite/acceptReject/{id}',[JsJobsController::class,'acceptReject'])->name('acceptReject');

        Route::get('/job/seeker/{id}', [ProfileController::class, 'getPDF'])->name('seeker.pdf');
        Route::post('/cv/feature', [ProfileController::class, 'createFeature'])->name('make.feature');

    });
});
