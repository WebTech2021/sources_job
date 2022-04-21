<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\JobApplication;
use App\Models\Jobs;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JS_jobsController extends Controller
{
    public function get_job_list(Request $request)
    {
        if (! \auth()->user()->career){
            $job_data = [];
        }else{
            $info = \auth()->user()->career->category->activeJobs();
            $job_data = jobCount(request()->employment_status, $info);
        }
        if (\request()->ajax()) {
            return DataTables::of($job_data)
                ->addIndexColumn()
                ->addColumn('action', function ($job_data) {
                    $now = Carbon::now();
                    if ($job_data->end_date > $now) {
                        return "expired";
                    } else {
                        return view('jobSeeker.jobs.action_button', compact('job_data'));
                    }
                })
                ->addColumn('nameWithImage', function ($job_data) {
                    $id =  $job_data->organization_id;
                    $logo =  DB::table('sources.organizations')->where('id','=',$id)->first()->logo;
                    $name = DB::table('sources.organizations')->where('id','=',$id)->first()->name;
                    return nameWithImage1($name, $logo, 'imagepath.companyLogo',
                        'images/company-logo/default-logo.png');
                })
                ->addColumn('employment_status', function ($job_data) {
                    if ($job_data->employment_status == 'full_time') {
                        return '<div>Full Time</div>';
                    } elseif ($job_data->employment_status == 'part_time') {
                        return '<dov>Part Time</dov>';
                    } elseif ($job_data->employment_status == 'contract') {
                        return '<div>Contract</div>';
                    } elseif ($job_data->employment_status == 'internship') {
                        return '<div>Internship</div>';
                    } else {
                        return '<div>Freelance</div>';
                    }

                })
                ->addColumn('salary', function ($job_data) {
                    if ($job_data->salary == 'negotiable') {
                        return '<div>Negotiable</div>';
                    } else {
                        return $job_data->salary;
                    }
                })
                ->addColumn('expire_date', function ($job_data) {
                    return \Carbon\Carbon::parse($job_data->to_date)->format('D, d M Y');
                })
                ->rawColumns(['nameWithImage', 'expire_date', 'salary', 'action', 'employment_status'])
                ->tojson();
        }

        return view('jobSeeker.jobs.index', compact('job_data'));

    }


    public function job_details($id)
    {
        $job_details = Jobs::find($id);
        return view('jobSeeker.jobs.show', compact('job_details'));
    }

    public function apply(Request $request, $id)
    {
        $apply_data = Jobs::find($id);
        JobApplication::create([
            'job_seeker_id' => Auth::guard('jobSeeker')->user()->id,
            'job_id' => $apply_data->id,
            'organization_id' => $apply_data->organization_id
        ]);
        Toastr::success('Apply Successfully!', 'success');
        return redirect()->back();
    }


//    public function getShortlist(){
//        if (\request()->ajax()) {
//            $list_data = JobApplication::where(['job_seeker_id'=> auth('jobSeeker')->user()->id,'status'=>'shortlisted'])->get();
//            return DataTables::of($list_data)
//                ->addIndexColumn()
//                ->addColumn('nameWithImage', function ($list_data) {
//                    $route = url('', ($list_data->organization->slug));
//                    return nameWithImage($list_data->organization->name, $list_data->organization->logo, 'imagepath.companyLogo',
//                        'images/company-logo/default-logo.png', $route);
//                })
//                ->addColumn('job_title', function ($list_data) {
////                    return $list_data->job->job_title;
//                    return $list_data->job->job_title ?? "";
//                })
//                ->addColumn('status', function ($list_data) {
//                    if ($list_data->status == 'shortlisted'){
//                        return  '<div class="badge badge-light-success">'.'you are short listed'.'</div>';
//                    }
//                })
//                ->rawColumns(['nameWithImage','job_title','status'])
//                ->tojson();
//        }
//        return view('jobSeeker.applicationStatus.index');
//    }






}
