<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureDataResource;
use App\Http\Resources\PaginateResource;
use App\Models\Admin\FeatureData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeatureSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $features = FeatureData::latest();
        return response()->json(['success' => true, 'features' => new PaginateResource($features->paginate(\request()->per_page ?? 20), FeatureDataResource::class)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:feature,urgent',
            'days' => [
                'required',
                Rule::unique('feature_data')->where(function ($query) use ($request){
                    return $query->where('type', $request->type)->where('days', $request->days);
                })
        ],
            'cost' => 'required|numeric',
        ]);
        try {
            $education = new FeatureData();
            $education->type = $request->type;
            $education->days = $request->days;
            $education->cost = $request->cost;
            $education->save();
            return response()->json(['success' => true, 'message' => 'Feature Setting Created!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Feature Setting Unable to Create!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|in:feature,urgent',
            'days' => 'required|numeric',
            'cost' => 'required|numeric',
        ]);
        try {
            $education = FeatureData::findOrFail(decrypt($id));
            $education->type = $request->type;
            $education->days = $request->days;
            $education->cost = $request->cost;
            $education->update();
            return response()->json(['success' => true, 'message' => 'Setting Updated!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Setting unable to delete!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $education = FeatureData::findOrFail(decrypt($id));
            $education->delete();
            return response()->json(['success' => true, 'message' => 'Setting Deleted!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => true, 'message' => 'Setting unable to delete!']);
        }
    }
}
