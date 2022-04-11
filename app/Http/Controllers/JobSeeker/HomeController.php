<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker\JobSeeker;
use App\Traits\UploadAble;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use UploadAble;

    public function index()
    {
        $jobSeeker = JobSeeker::findOrfail(\auth()->user()->id);
        return view('jobSeeker.dashboard.index',compact('jobSeeker'));
    }
    public function login()
    {
        return view('jobSeeker.auth.login');
    }

    public function view_jobSeeker_profile()
    {
        $data = Auth::user();
        return view('jobSeeker.profile.personal', compact('data'));
    }

    public function update_general_info(Request $request,$id)
    {
//        dd ($request->all());
        $employee = JobSeeker::find($id);
        if ($request->has('image')) {
            $filename = $this->uploadOne($request->image,300,300, config('imagepath.profile'));
            $this->deleteOne(config('imagepath.profile'),$employee->image);
            $employee->update(['image' => $filename]);
        }
        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
        ]);
        Toastr::success('Information changed Successfully!','Success');
        return redirect()->back();
    }
    public function update_password_info(Request $request,$id)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);
        $employee = JobSeeker::find($id);
        if (!\Hash::check($request->password, $employee->password)) {
            Toastr::error('Fill password filed correctly!','Error');
            return back();
        } else {
            $employee = JobSeeker::find($id);
            $employee->password = bcrypt($request->new_password);
            $employee->save();
            Toastr::success('Password changed Successfully!','Success');
            return redirect()->back();
        }
    }
}



