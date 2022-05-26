<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Http\Resources\PaginateResource;
use App\Models\Admin\Education;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EducationController extends Controller
{

    public function index()
    {
        $educations = Education::latest();
        return response()->json(['success' => true, 'educations' => new PaginateResource($educations->paginate(\request()->per_page ?? 20), EducationResource::class)]);

    }

    public function show($id)
    {
        $education = Education::findOrFail(decrypt($id));
        return response()->json(['success' => true, 'education' => new EducationResource($education)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:education,name',
        ]);
        try {
            $education = new Education();
            $education->name = $request->name;
            $education->save();
            return response()->json(['success' => true, 'message' => 'Education Created!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Education Unable to Create!']);
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $education = Education::findOrFail(decrypt($id));
            $education->name = $request->name;
            $education->update();
            return response()->json(['success' => true, 'message' => 'Education Updated!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Education unable to delete!']);
        }
    }

    public function destroy($id)
    {
        try {
            $education = Education::findOrFail(decrypt($id));
            $education->delete();
            return response()->json(['success' => true, 'message' => 'Education Deleted!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => true, 'message' => 'Education unable to delete!']);
        }

    }
}
