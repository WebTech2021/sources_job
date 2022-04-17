<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $category = JobCategory::latest();
            return DataTables::of($category)
                ->addIndexColumn()
                ->addColumn('action', function ($category) {
                    return view('admin.jobCategory.action_button', compact('category'));
                })
                ->rawColumns(['action'])
                ->tojson();
        }
        return view('admin.jobCategory.index');
    }

    public function create()
    {
        return view('admin.jobCategory.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $category = new JobCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        Toastr::success('Information Create successfully','Success');
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = JobCategory::findOrFail(decrypt($id));
        return view('admin.jobCategory.edit',compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $category = JobCategory::findOrFail(decrypt($id));
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->update();
        Toastr::success('Information Update successfully','Success');
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = JobCategory::findOrFail(decrypt($id));
        $category->delete();
        Toastr::success('Information Delete successfully','Success');
        return back();
    }
}
