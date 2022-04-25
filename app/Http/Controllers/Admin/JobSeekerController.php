<?php

namespace App\Http\Controllers\Admin;

use App\Exports\JobSeekerExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobSeekerResource;
use App\Http\Resources\PaginateResource;
use App\Mail\JobSeekerBlocked;
use App\Models\Jobs;
use App\Models\JobSeeker\JobSeeker;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class JobSeekerController extends Controller
{
    public function getJobSeekerList()
    {
        $seekers = JobSeeker::latest('last_seen_at');
//      return  $job_seeker = JobSeeker::all();
//        if (\request()->ajax()) {
//            $job_seeker = JobSeeker::latest('last_seen_at');
//            return DataTables::of($job_seeker)
//                ->addIndexColumn()
//                ->addColumn('nameWithImage', function ($job_seeker) {
//                    $now = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
//                    if ($job_seeker->last_seen_at >= $now) {
//                        $online = true;
//                    } else {
//                        $online = false;
//                    }
//                    $route = route('admin.login', encrypt($job_seeker->id));
//                    return nameWithImage($job_seeker->first_name.' '.$job_seeker->last_name, $job_seeker->image, 'imagepath.profile', 'images/profile/dummy.jpg',
//                        $route,$online);
//                })
//                ->addColumn('onlineStatus', function ($job_seeker) {
//                    $now = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
//                    if ($job_seeker->last_seen_at >= $now) {
//                        return '<div class="badge badge-success">Online</div>';
//                    } else {
//                        return $job_seeker->last_seen_at !== null ? $job_seeker->last_seen_at->diffForHumans() : '-';
//                    }
//                })
//                ->addColumn('linkWithEmail', function ($job_seeker) {
//                    $verify = $job_seeker->email_verified_at ? '&nbsp <i class="fa fa-check-circle text-success" aria-hidden="true">'.'</i>' : '';
//                    return '<a href="mailto:'.$job_seeker->email.'" target="_blank">'.$job_seeker->email.'</a>'.$verify;
//                })
//                ->addColumn('js_status', function ($job_seeker) {
//                    if ($job_seeker->status == 'active'){
//                        return '<div class="badge badge-light-success">active</div>';
//                    }elseif ($job_seeker->status == 'inactive'){
//                        return '<div class="badge badge-light-secondary">inactive</div>';
//                    }else{
//                        return '<div class="badge badge-light-danger">blocked</div>';
//                    }
//                })
//                ->addColumn('action', function ($job_seeker) {
//                    return view('admin.jobSeeker.action-button', compact('job_seeker'));
//                })
//                ->rawColumns(['action','linkWithEmail','nameWithImage','js_status','onlineStatus'])
//                ->tojson();
//        }
        return response()->json(['success' => true, 'seekers' => new PaginateResource($seekers->paginate(15), JobSeekerResource::class)]);
    }

    public function activeInactiveBlocked(Request $request, $id)
    {
        try {
            $job_seeker = JobSeeker::findOrFail(decrypt($id));
            $job_seeker->update([
                'status' => $request->status,
            ]);
            if ($job_seeker->status == 'blocked') {
                Mail::to($job_seeker->email)->send((new JobSeekerBlocked($job_seeker))->delay(now()->addSeconds(5)));
            }
            return response()->json(['success' => true, 'message' => 'Status changed!']);
        } catch (\Exception $e) {
            info($e);
        }
    }
    public function changeJobStatus(Request $request, $id)
    {
        try {
            $job = Jobs::where(['status'=>'pending', 'slug'=>$id])->first();
            $job->update([
                'status' => $request->status,
            ]);
            return response()->json(['success' => true, 'message' => 'Status changed!']);
        } catch (\Exception $e) {
            info($e);
        }
    }

    public function ExportJobSeeker()
    {
        return Excel::download(new JobSeekerExport(), 'jobSeeker.xlsx');
    }

    public function loginAsJobSeeker(Request $request)
    {
        Auth::guard('jobSeeker')->loginUsingId($request->id);
        session(['loggedIn-from-admin' => true]);
        return redirect()->route('jobSeeker.login');
    }

    public function getJobList()
    {
        $job_list = Jobs::latest();
//      if (\request()->ajax()) {
//          return DataTables::of($job_list)
//              ->addIndexColumn()
//              ->addColumn('organization_name', function ($job_list) {
//                  $id =  $job_list->organization_id;
//                 return DB::table('sources.organizations')->where('id','=',$id)->first()->name;
//              })
//              ->addColumn('status', function ($job_list) {
//                  if ($job_list->status == 'publish'){
//                      return '<div class="badge badge-light-success">Publish</div>';
//                  }elseif ($job_list->status == 'draft'){
//                      return '<div class="badge badge-light-warning">Draft</div>';
//                  }else{
//                      return '<div class="badge badge-light-danger">Expired</div>';
//                  }
//              })
//
//              ->rawColumns(['status'])
//              ->tojson();
//      }
        return response()->json(['success' => true, 'jobs' => new PaginateResource($job_list->paginate(15), JobResource::class)]);

    }

}
