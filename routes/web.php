<?php

use Illuminate\Support\Facades\Route;

//require('admin.php');
require('jobSeeker.php');

Route::view('/{any}', 'application')->where('any', '.*');
