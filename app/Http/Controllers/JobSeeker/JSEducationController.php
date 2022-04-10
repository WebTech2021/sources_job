<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker\jsEducation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JSEducationController extends Controller
{
    public function index()
    {
        $educations = jsEducation::where('job_seeker_id',auth('jobSeeker')->user()->id)->get();
        return view('jobSeeker.education.index',compact('educations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'education_level'=>'required',
            'education_board'=>'required',
            'degree_title'=>'required',
            'group'=>'required',
            'institute_name'=>'required',
            'result'=>'required|numeric',
            'passing_year'=>'required|numeric',
        ]);
        $education = new jsEducation();
        $education->job_seeker_id = Auth::user()->id;
        $education->fill($request->all());
        $education->save();
        Toastr::success('Information Added Successfully!','Success');
        return back();
    }
    public function edit($id)
    {
        try {
            $education = jsEducation::findOrFail(decrypt($id));
            return view('jobSeeker.education.edit',compact('education'));
        }catch (DecryptException $e){
            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'education_level'=>'required',
            'education_board'=>'required',
            'degree_title'=>'required',
            'group'=>'required',
            'institute_name'=>'required',
            'result'=>'required|numeric',
            'passing_year'=>'required|numeric',
        ]);
        try {
            $education = jsEducation::findOrFail(decrypt($id));
            $education->update($request->except(['token']));
            Toastr::success('Information Updated Successfully!','Updated.');
            return  redirect()->route('jobSeeker.education.index');

        }catch (DecryptException $e){
            abort(404);
        }
    }

    public function destroy($id)
    {
        try {
            $education = jsEducation::findOrFail(decrypt($id));
            $education->delete();
            Toastr::success('Information deleted successfully', 'Deleted.');
            return redirect()->route('jobSeeker.education.index');
        } catch (DecryptException $e) {
            abort(404);
        }

    }
}
