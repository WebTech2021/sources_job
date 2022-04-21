<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    include('admin_api.php');
});
