<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobUpdateRequest;
use App\Http\Resources\JobDetailResource;
use App\Http\Resources\JobResource;
use App\Models\Jobs;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $job = Jobs::where('slug', $id)->first();
        }catch (\Exception $exception){
            return response()->json(['success'=>false, 'message'=>$exception->getMessage()]);
        }
        return response()->json(['success'=>true, 'job'=>new JobDetailResource($job)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(JobUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            $job = Jobs::where('slug', $id)->first();
            $job->fill($validated);
            $job->save();
        }catch (\Exception $exception){
            return response()->json(['success'=>false, 'message'=>$exception->getMessage()]);
        }
        return response()->json(['success'=>true, 'message'=>'Job updated!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
