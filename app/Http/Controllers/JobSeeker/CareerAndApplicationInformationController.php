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
        $job_categories = JobCategory::select('id','name')->orderBy('name', 'asc')->get();
        $categories = Category::where('sector', 'industry')->select('id','name')->orderBy('name', 'asc')->get();
        $info = CareerAndApplicationInformation::where('job_seeker_id',\auth()->user()->id)->first();
        if ($info){
            return redirect()->route('jobSeeker.info-edit',compact('categories','job_categories'));
        }else{
            return view('jobSeeker.career_info.create',compact('categories','job_categories'));
        }
    }
    public function storeInfo(CareerInfoRequest $request){
//        return $request->all();
        CareerAndApplicationInformation::create([
            'job_seeker_id' => Auth::user()->id,
            'job_level' => $request->job_level,
            'job_nature' => $request->job_nature,
            'present_salary' => $request->present_salary,
            'expected_salary' => $request->expected_salary,
            'objective' => $request->objective,
            'pre_job_categories' => implode(',', $request->pre_job_categories),
            'pre_organization_type' => implode(',', $request->pre_organization_type),
            'pre_job_location' => $request->pre_job_location,
            'career_summary' => $request->career_summary,
            'special_qualification' => $request->special_qualification,
        ]);
        Toastr::success('Information Added Successfully!','Success');
        return redirect()->route('jobSeeker.info-edit');
    }
    public function editInfo(){
        $info = CareerAndApplicationInformation::where('job_seeker_id',\auth()->user()->id)->first();
        $job_categories = JobCategory::select('id','name')->orderBy('name', 'asc')->get();
        $categories = Category::where('sector', 'industry')->select('id','name')->orderBy('name', 'asc')->get();
        if (!$info) {
            return view('jobSeeker.career_info.create',compact('categories','job_categories'));
        }
        $SelectedType = explode(',', $info->pre_organization_type);
        $categoryType = explode(',', $info->pre_job_categories);
        return view('jobSeeker.career_info.update_career_info',compact('info','SelectedType','categoryType','categories','job_categories'));
    }
    public function update_career_info(Request $request){
        $request->validate([
            'objective'=>'max:760',
            'special_qualification'=>'max:760',
            'career_summary'=>'max:760',
            'present_salary' => 'integer|digits_between:2,10',
            'expected_salary' => 'integer|digits_between:2,10',
        ]);
        $string = implode(',',$request->pre_organization_type);
        $category = implode(',',$request->pre_job_categories);
        $info = CareerAndApplicationInformation::where('job_seeker_id',\auth()->user()->id)->first();
        $info->update($request->except(['token','pre_organization_type','pre_job_categories']));
        $info->update(['pre_organization_type'=>$string,'pre_job_categories'=>$category]);
        Toastr::success('Information Updated Successfully!','Updated.');
        return back();
    }

}
