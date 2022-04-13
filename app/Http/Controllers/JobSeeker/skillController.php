<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker\Skills;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class skillController extends Controller
{
    public function createSkill(){
        $skills = Skills::where('job_seeker_id',\auth()->user()->id)->get();
        return view('jobSeeker.skills.index',compact('skills'));
    }

    public function storeSkill(Request $request){
        $request->validate([
           'skill'=>'required'
        ]);
//         return $request->all();
         $skill = new Skills();
         $skill->job_seeker_id = Auth::user()->id;
         $skill->fill($request->all());
         $skill->save();
        Toastr::success('Information Added Successfully!','Success');
        return back();
    }
    public function destroy($id){
       $skill = Skills::findOrFail(decrypt($id));
       $skill->delete();
        Toastr::success('Information Delete Successfully!','Success');
        return back();
    }
}
