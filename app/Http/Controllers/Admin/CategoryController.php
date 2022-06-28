<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginateResource;
use App\Models\JobCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = JobCategory::latest();
        return response()->json(['success' => true, 'categories' => new PaginateResource($categories->paginate(\request()->per_page ?? 20), CategoryResource::class)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:job_categories,name',
        ]);
        try {
            $category = new JobCategory();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();
            return response()->json(['success' => true, 'message' => 'Category Created!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Category Unable to Create!']);
        }
    }

    public function show($id)
    {
        $category = JobCategory::findOrFail(decrypt($id));
        return response()->json(['success' => true, 'category' => new CategoryResource($category)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $category = JobCategory::findOrFail(decrypt($id));
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->update();
            return response()->json(['success' => true, 'message' => 'Category Updated!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => true, 'message' => 'Category unable to delete!']);
        }
    }

    public function jobCategories()
    {
        $parentCategories = JobCategory::query();
        if (\request()->cat === 'seeker') {
            $parentCategories = $parentCategories->with('activeJobSeekers')->withCount('activeJobSeekers as seeker_count');
        } else {
            $parentCategories = $parentCategories->with('activeJobs')->withCount('activeJobs as job_count');
        }
        if (strlen($key = \request('key')) > 0) {
            $parentCategories = $parentCategories->where('name', 'LIKE', "%$key%");
        }
        if (!$parentCategories) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 404);
        }
        return response()->json(['success' => true, 'categories' => new PaginateResource($parentCategories->paginate(20), CategoryResource::class)]);
    }

    public function destroy($id)
    {
        try {
            $category = JobCategory::where('slug', $id)->first();
            $category->delete();
            return response()->json(['success' => true, 'message' => 'Category Deleted!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Category unable to delete!']);
        }
    }
}
