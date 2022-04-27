<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    include('admin_api.php');
    Route::get('job/seeker/{id}', [\App\Http\Controllers\Api\CvApiController::class, 'getPDF'])->name('seeker.cv');
});

