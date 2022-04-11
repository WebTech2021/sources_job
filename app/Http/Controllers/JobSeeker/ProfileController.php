<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInfoRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\JobSeeker\CareerAndApplicationInformation;
use App\Models\JobSeeker\JobSeeker;
use App\Models\JobSeeker\jsEducation;
use App\Models\JobSeeker\jsExperience;
use App\Models\JobSeeker\Reference;
use App\Models\Upazila;
use App\Traits\UploadAble;
use Brian2694\Toastr\Facades\Toastr;

class ProfileController extends Controller
{
    use UploadAble;
    public function edit_profile()
    {
        $jobSeeker = JobSeeker::findOrfail(\auth()->user()->id);
        $divisions = Division::orderBy('name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        $upazilas = Upazila::orderBy('name', 'asc')->get();
        return view('jobSeeker.personal.index',compact('divisions','districts','upazilas','jobSeeker'));
    }
    public function update_profile(PersonalInfoRequest $request,$id){
//        return ($request->all());
        $jobSeeker = JobSeeker::find($id);
        if ($request->hasFile('image')) {
            $filename = $this->uploadOne($request->image,300,300, config('imagepath.profile'));
            $this->deleteOne(config('imagepath.profile'),$jobSeeker->image);
            $jobSeeker->update(['image' => $filename]);
        }
        $info = implode(',', $request->language);
        $skills = implode(',', $request->skills);
        $jobSeeker->update($request->except(['token','image','language','skills']));
        $jobSeeker->update(['language'=>$info,'skills'=>$skills]);
        Toastr::success('Information changed Successfully!','Success');
        return  redirect()->back();
    }

    public function  cv_preview(){
        $jobSeeker = JobSeeker::findOrfail(\auth()->user()->id);
        $divisions = Division::orderBy('name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        $upazilas = Upazila::orderBy('name', 'asc')->get();
        $experiences = jsExperience::where('job_seeker_id',auth('jobSeeker')->user()->id)->get();
        $educations = jsEducation::where('job_seeker_id',auth('jobSeeker')->user()->id)->get();
        $carerInfo = CareerAndApplicationInformation::where('job_seeker_id',auth('jobSeeker')->user()->id)->first();
        $reference = Reference::where('job_seeker_id',auth('jobSeeker')->user()->id)->get();
        return view('employee.dashboard.profilePreview',compact('reference','divisions','districts','upazilas','jobSeeker','experiences','educations','carerInfo'));
    }




}
