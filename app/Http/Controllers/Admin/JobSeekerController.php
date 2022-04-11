<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\JobSeekerBlocked;
use App\Models\JobSeeker\JobSeeker;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class JobSeekerController extends Controller
{
    public function getJobSeekerList(){
//      return  $job_seeker = JobSeeker::all();
        if (\request()->ajax()) {
            $job_seeker = JobSeeker::latest('last_seen_at');
            return DataTables::of($job_seeker)
                ->addIndexColumn()
//                ->addColumn('name', function ($job_seeker) {
//                    return $job_seeker->first_name.' '.$job_seeker->last_name;
//                })
                ->addColumn('nameWithImage', function ($job_seeker) {
                    $now = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
                    if ($job_seeker->last_seen_at >= $now) {
                        $online = true;
                    } else {
                        $online = false;
                    }
                    $route = route('admin.login', encrypt($job_seeker->id));
                    return nameWithImage($job_seeker->first_name.' '.$job_seeker->last_name, $job_seeker->image, 'imagepath.profile', 'images/profile/dummy.jpg',
                        $route,$online);
                })
                ->addColumn('onlineStatus', function ($job_seeker) {
                    $now = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
                    if ($job_seeker->last_seen_at >= $now) {
                        return '<div class="badge badge-success">Online</div>';
                    } else {
                        return $job_seeker->last_seen_at !== null ? $job_seeker->last_seen_at->diffForHumans() : '-';
                    }
                })
                ->addColumn('linkWithEmail', function ($job_seeker) {
                    $verify = $job_seeker->email_verified_at ? '&nbsp <i class="fa fa-check-circle text-success" aria-hidden="true">'.'</i>' : '';
                    return '<a href="mailto:'.$job_seeker->email.'" target="_blank">'.$job_seeker->email.'</a>'.$verify;
                })
                ->addColumn('js_status', function ($job_seeker) {
                    if ($job_seeker->status == 'active'){
                        return '<div class="badge badge-light-success">active</div>';
                    }elseif ($job_seeker->status == 'inactive'){
                        return '<div class="badge badge-light-secondary">inactive</div>';
                    }else{
                        return '<div class="badge badge-light-danger">blocked</div>';
                    }
                })
                ->addColumn('action', function ($job_seeker) {
                    return view('admin.jobSeeker.action-button', compact('job_seeker'));
                })
                ->rawColumns(['action','linkWithEmail','nameWithImage','js_status','onlineStatus'])
                ->tojson();
        }
        return view('admin.jobSeeker.index');
    }

    public function activeInactiveBlocked(Request $request, $id)
    {
//        return  $request->all();
        try {
            $decrypted = decrypt($id);
            $job_seeker = JobSeeker::findOrFail($decrypted);
            $job_seeker->update([
                'status' => $request->status,
            ]);
            if ($job_seeker->status == 'blocked') {
                Mail::to($job_seeker->email)->send((new JobSeekerBlocked($job_seeker))->delay(now()->addSeconds(5)));
            }
        } catch (\Exception $e) {
            info($e);
            Toastr::error('Invalid URL', 'Error');
        }

        Toastr::success('Job Seeker'.' '."<strong>$job_seeker->first_name $job_seeker->last_name</strong>".' '."{$request->status} Successfully");
        return back();
    }

    public function ExportJobSeeker(){
        return Excel::download(new JobSeekerExport(), 'jobSeeker.xlsx');
    }


    public function  loginAsJobSeeker(Request $request){
        Auth::guard('jobSeeker')->loginUsingId($request->id);
        session(['loggedIn-from-admin' => true]);
        return redirect()->route('jobSeeker.login');

    }
}
