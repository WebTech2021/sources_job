<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerInfoRequest;
use App\Models\Admin\Category;
use App\Models\JobCategory;
use App\Models\JobSeeker\CareerAndApplicationInformation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareerAndApplicationInformationController extends Controller
{
    public function getCareerInfo(){
        $info = CareerAndApplicationInformation::where('job_seeker_id',\auth()->user()->id)->first();
        if ($info){
            return redirect()->route('jobSeeker.info-edit');
        }else{
            return view('jobSeeker.career_info.create');
        }
    }
    public function storeInfo(CareerInfoRequest $request){
//        return $request->all();
        CareerAndApplicationInformation::create([
            'job_seeker_id' => Auth::user()->id,
            'objective' => $request->objective,
            'career_summary' => $request->career_summary,
            'special_qualification' => $request->special_qualification,
        ]);
        Toastr::success('Information Added Successfully!','Success');
        return redirect()->route('jobSeeker.info-edit');
    }
    public function editInfo(){
        $info = CareerAndApplicationInformation::where('job_seeker_id',\auth()->user()->id)->first();
        if (!$info) {
            return view('jobSeeker.career_info.create');
        }
        return view('jobSeeker.career_info.update_career_info',compact('info'));
    }
    public function update_career_info(Request $request){
        $request->validate([
            'objective'=>'max:760',
            'special_qualification'=>'max:760',
            'career_summary'=>'max:760',
        ]);
        $info = CareerAndApplicationInformation::where('job_seeker_id',\auth()->user()->id)->first();
        $info->update($request->except(['token']));
        Toastr::success('Information Updated Successfully!','Updated.');
        return back();
    }

}
