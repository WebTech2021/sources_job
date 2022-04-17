<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Education;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EducationController extends Controller
{

    public function index()
    {
        $educations = Education::all();
        return view('admin.education.index',compact('educations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);
        $education =new Education();
        $education->name = $request->name;
        $education->save();
        Toastr::success('Information Create successfully','Success');
        return back();
    }

    public function destroy($id)
    {
        $education = Education::findOrFail(decrypt($id));
        $education->delete();
        Toastr::success('Information Delete successfully','Success');
        return back();

    }
}
