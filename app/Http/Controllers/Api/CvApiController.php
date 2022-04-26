<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JobSeeker\ProfileController;
use App\Models\JobSeeker\JobSeeker;
use Illuminate\Http\Request;

class CvApiController extends Controller
{
    public function getPDF($id)
    {
       $c= new ProfileController();
       $c->getPDF($id);
    }

}
