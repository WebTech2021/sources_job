<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInfoRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\JobSeeker\Feature;
use App\Models\JobSeeker\JobSeeker;
use App\Models\Upazila;
use App\Traits\UploadAble;
use Brian2694\Toastr\Facades\Toastr;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

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
        $jobSeeker->update($request->except(['token','image','language']));
        $jobSeeker->update(['language'=>$info]);
        Toastr::success('Information Changed Successfully!','Success');
        return  redirect()->back();
    }

    public function  cv_preview(){
         $jobSeeker = JobSeeker::with('career','skill','objective','experiences','education','reference','portfolio')
            ->findOrfail(\auth()->user()->id);
//         return $jobSeeker->experiences;
        return view('jobSeeker.dashboard.profilePreview',compact('jobSeeker'));
    }

    public function getPDF($id){
        $seeker_details = JobSeeker::with('career','skill','objective','experiences','education','reference','portfolio')
            ->findOrfail(\auth()->user()->id ?? $id);
         $data = [
            'seeker_details' => $seeker_details,
          ];
         $pdf = PDF::loadHtml(view('jobSeeker.dashboard.pdf', $data));
        return $pdf->stream( $seeker_details->first_name.' '.$seeker_details->last_name.'.pdf');
    }

    public function createFeature(){
        if (Feature::where('featurable_id', '=', auth()->user()->id)->exists()){
            Toastr::error('Already Promote listed!','Error');
            return  redirect()->back();
        }else{
            Feature::create([
                'type' => 'feature',
                'featurable_type' => JobSeeker::class,
                'featurable_id' => auth('jobSeeker')->user()->id,
            ]);
            return back();
        }
    }


}
