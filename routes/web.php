<?php

use Illuminate\Support\Facades\Route;

//require('admin.php');
include('jobSeeker.php');

Route::view('/{any}', 'application')->where('any', '.*');
