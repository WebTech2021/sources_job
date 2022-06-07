<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker\jsExperience;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JSExperienceController extends Controller
{
    public function index()
    {
        $experiences = jsExperience::where('job_seeker_id',auth('jobSeeker')->user()->id)->get();
        return view('jobSeeker.experience.index',compact('experiences'));
    }

    public function  create(){
        return view('jobSeeker.experience.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'designation'=>'required',
            'department'=>'required',
            'company_name'=>'required',
            'company_location'=>'required',
            'experience'=>'required',
            'start_date'=>'required',
            'currently_working'=>'required',
        ]);
        $experience = new jsExperience();
        $experience->job_seeker_id = Auth::user()->id;
        $experience->fill($request->all());
        $experience->save();
        Toastr::success('Information Added Successfully!','Success');
        return back();
    }
    public function edit($id)
    {
        try {
            $experience = jsExperience::findOrFail(decrypt($id));
            return view('jobSeeker.experience.edit',compact('experience'));

        }catch (DecryptException $e){
            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'designation'=>'required',
            'department'=>'required',
            'company_name'=>'required',
            'company_location'=>'required',
            'experience'=>'required',
            'start_date'=>'required',
            'currently_working'=>'required',
        ]);

        try {
            $experience = jsExperience::findOrFail(decrypt($id));
            if($request->currently_working == 'yes'){
                $experience->end_date = null;
                $experience->update($request->except(['token','end_date']));

            }elseif($request->currently_working == 'no'){
                $experience->update($request->except(['token']));
            }
            Toastr::success('Information Update Successfully!','Updated');
            return redirect()->route('jobSeeker.experience.index');
        }catch (DecryptException $e){
            abort(404);
        }

    }
    public function destroy($id)
    {
        try {
            $experience = jsExperience::findOrFail(decrypt($id));
            $experience->delete();
            Toastr::success('Information deleted successfully', 'Deleted.');
            return redirect()->route('jobSeeker.experience.index');
        } catch (DecryptException $e) {
            abort(404);
        }
    }
}
