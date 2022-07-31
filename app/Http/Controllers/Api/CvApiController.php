<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JobSeeker\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CvApiController extends Controller
{
    public function getPDF(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:job_seekers,id'
        ]);
        if ($validator->fails()) {

            return redirect(config('app.mix_sources_url').'/seller/job-invite/accept-list')->with('msg', 'The Message');
        }
        $id = $request->id;
        $c = new ProfileController();
        $c->getPDF($id);
    }

}
