<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Admin\Education;
use App\Models\District;
use App\Models\JobCategory;
use App\Models\JobSeeker\JobSeeker;
use App\Models\JobSeeker\KeyFeatures;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class KeyFeatureController extends Controller
{
    public function KeyFeature(){
        $keyFeatures = KeyFeatures::where('job_seeker_id',\auth()->user()->id)->first();
        $jobSeeker = JobSeeker::findOrfail(\auth()->user()->id);
        $districts = District::orderBy('name', 'asc')->get();
        $jobCategories = JobCategory::select('name')->orderBy('name', 'asc')->get();
        $educations = Education::select('name')->orderBy('name', 'asc')->get();
        return view('jobSeeker.keyFeature.create',compact('jobSeeker','districts','jobCategories','keyFeatures','educations'));
    }

    public function create_KeyFeature(Request $request, $id = null){
        $request->validate([
            'profession'=>'required',
            'education'=>'required',
            'experience'=>'required',
            'salary'=>'required',
            'job_type'=>'required',
            'location'=>'required',
            'available_status'=>'required'
        ]);
        if($id)
        {
            $keyFeature = KeyFeatures::find($id);
            if($keyFeature)
            {
                $keyFeature->update($request->all());
                Toastr::success('Information Update Successfully!','Success');
                return redirect()->route('jobSeeker.key_features.create');
            }
        }
        else
        {
            $keyFeature= new KeyFeatures();
            $keyFeature->job_seeker_id = Auth::user()->id;
            $keyFeature->fill($request->all());
            $keyFeature->save();
            Toastr::success('Information Create Successfully!','Success');
            return  redirect()->route('jobSeeker.key_features.create');
        }
    }
}
