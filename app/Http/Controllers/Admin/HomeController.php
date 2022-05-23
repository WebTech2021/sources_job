<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\District;
use App\Models\Upazila;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class HomeController extends Controller
{
//    use UploadAble;

    public function getDashboard()
    {
        return view('admin.home.dashboard');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    //admin profile show
    public function view_profile()
    {
        $data = Auth::user();
        return view('admin.profile.edit', compact('data'));
    }

    public function update_general(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4|max:32|regex:/^[a-zA-Z\s]+$/',
            'image' => 'image|mimes:jpg,png,jpeg|max:512',
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'dob' => 'nullable|date|date_format:Y-m-d',
        ]);
        $admin = Admin::find($id);
        if ($request->hasFile('image')) {
            $filename = $this->uploadOne($request->image, 300, 300, config('imagepath.profile'));
            $this->deleteOne(config('imagepath.profile'), $admin->image); //delete old photo from directory
            $admin->update(['image' => $filename]);    //update new filename
        }
//        $admin->dob = Carbon::parse($request->dob)->format('d-m-Y');
        $admin->update([
            'name' => strip_tags($request->name),
            'phone_number' => strip_tags($request->phone),
            'dob' => !empty($request->dob) ? $request->dob : null,
        ]);
        Toastr::success('Information changed Successfully!', 'Success');
        return redirect()->back();
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);
        $admin = Admin::find($id);
        if (!\Hash::check($request->password, $admin->password)) {
            Toastr::error("Old password doesn't match !", 'Error');
            return back();
        } else {
            $admin = Admin::find($id);
            $admin->password = bcrypt($request->new_password);
            $admin->save();
            Toastr::success('Password changed Successfully!', 'Success');
            return redirect()->back();
        }
    }
    //Get district by division
    public function get_by_division(Request $request)
    {
        if (!$request->division_id) {
            $html = '<option value="">'.trans('Select division first').'</option>';
        } else {
            $html = '<option value="" disabled selected>Choose district</option>';
            $districts = District::where('division_id', $request->division_id)->orderBy('name', 'asc')->get();
            foreach ($districts as $district) {
                $html .= '<option value="'.$district->id.'">'.$district->name.'</option>';
            }
        }
        return response()->json(['html' => $html]);
    }

    //Get upazila by district
    public function get_by_district(Request $request)
    {
        if (!$request->district_id) {
            $html = '<option value="">'.trans('Select district first').'</option>';
        } else {
            $html = '<option value="" disabled selected>Choose upazila</option>';
            $upazilas = Upazila::where('district_id', $request->district_id)->orderBy('name', 'asc')->get();
            foreach ($upazilas as $upazila) {
                $html .= '<option value="'.$upazila->id.'">'.$upazila->name.'</option>';
            }
        }
        return response()->json(['html' => $html]);
    }
}
