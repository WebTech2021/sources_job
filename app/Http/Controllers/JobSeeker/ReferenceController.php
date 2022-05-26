<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker\Reference;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class ReferenceController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $ref_data = Reference::where(['job_seeker_id'=> \auth('jobSeeker')->user()->id])->latest();
            return DataTables::of($ref_data)->addIndexColumn()
                ->addColumn('action', function ($ref_data) {
                    return view('jobSeeker.reference.action_button',compact('ref_data'));
                })
                ->addColumn('status', function ($ref_data) {
                    if ($ref_data->status == 'active'){
                        return '<div class="badge badge-success">Active</div>';
                    }else{
                        return '<div class="badge badge-danger">Inactive</div>';
                    }
                })
                ->rawColumns(['action','status'])->tojson();
        }
        return view('jobSeeker.reference.index');
    }

    public function create()
    {
        return view('jobSeeker.reference.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns|unique:references,email',
            'phone_number' => 'required|bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
        ]);
        $reference = new Reference();
        $reference->job_seeker_id = Auth::user()->id;
        $reference->fill($request->all());
        $reference->save();
        Toastr::success('Information Added Successfully!','Success');
        return back();
    }

    public function edit($id)
    {
        $ref_data = Reference::findOrFail(decrypt($id));
        return view('jobSeeker.reference.edit',compact('ref_data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'email:rfc,dns',
            'phone_number' => 'required|bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
        ]);
        $reference = Reference::findOrFail(decrypt($id));
        $reference->update($request->except(['token']));
        Toastr::success('Information Updated Successfully!','Updated.');
        return  redirect()->route('jobSeeker.reference.index');
    }

    public function destroy($id)
    {
        Reference::findOrFail(decrypt($id))->delete();
        Toastr::success('Information Delete Successfully!','Delete.');
        return back();

    }
}
