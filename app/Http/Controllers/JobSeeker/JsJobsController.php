<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\JobApplication;
use App\Models\Jobs;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JsJobsController extends Controller
{
    public function get_job_list(Request $request)
    {
        if (!\auth()->user()->career) {
            $job_data = [];
        } else {
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
                    $id = $job_data->organization_id;
                    $logo = $this->getSourcesOrgTable()->where('id', '=', $id)->first()->logo;
                    $name = $this->getSourcesOrgTable()->where('id', '=', $id)->first()->name;
                    $image = '<img src="'.config('app.seller_image_url').$logo.'" style="width: 30px; height: 30px; border-radius: 50%;">';
                    return $image.'  '. ucwords($name);

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
                ->addColumn('job_title', function ($job_data) {
                    return '<a href="' . route('jobSeeker.jobs.details', encrypt($job_data->id)) . '">' . $job_data->job_title. '</a>';
                })
                ->rawColumns(['nameWithImage', 'expire_date', 'salary', 'action', 'employment_status', 'job_title'])
                ->tojson();
        }

        return view('jobSeeker.jobs.index', compact('job_data'));

    }


    public function job_details($id)
    {
//      return  $job_details = Jobs::findOrfail(decrypt($id));

        try {
            $job_details = Jobs::findOrfail(decrypt($id));
            $id = $job_details->organization_id;
            $name = $this->getSourcesOrgTable()->where('id', '=', $id)->first()->name;
            return view('jobSeeker.jobs.show', compact('job_details','name'));

        } catch (DecryptException $e) {
            Toastr::error('Something went wrong!', 'Error');
            return back();
        }

    }

    public function apply(Request $request, $id)
    {
//      return  $apply_data = Jobs::findOrfail(decrypt($id));

        try {
            $apply_data = Jobs::findOrfail(decrypt($id));
            JobApplication::create([
                'job_seeker_id' => Auth::guard('jobSeeker')->user()->id,
                'job_id' => $apply_data->id,
                'organization_id' => $apply_data->organization_id
            ]);
            Toastr::success('Apply Successfully!', 'success');
            return redirect()->back();

        } catch (DecryptException $e) {
            Toastr::error('Something went wrong!', 'Error');
            return back();
        }

    }

    public function inviteList()
    {
        if (\request()->ajax()) {
            $list_data = Invite::where(['job_seeker_id' => auth('jobSeeker')->user()->id])->latest();
            return DataTables::of($list_data)
                ->addIndexColumn()
                ->addColumn('nameWithImage', function ($list_data) {
                    $id = $list_data->organization_id;
                    $logo = $this->getSourcesOrgTable()->where('id', '=', $id)->first()->logo;
                    $name = $this->getSourcesOrgTable()->where('id', '=', $id)->first()->name;
                    $image = '<img src="'.config('app.seller_image_url').$logo.'" style="width: 30px; height: 30px; border-radius: 50%;">';
                    return $image.'  '. ucwords($name);
                })
                ->addColumn('email', function ($list_data) {
                    $id = $list_data->organization_id;
                    return $this->getSourcesOrgTable()->where('id', '=', $id)->first()->email;
                })
                ->addColumn('phone', function ($list_data) {
                    $id = $list_data->organization_id;
                    return $this->getSourcesOrgTable()->where('id', '=', $id)->first()->phone_number;
                })
                ->addColumn('address', function ($list_data) {
                    $id = $list_data->organization_id;
                    return $this->getSourcesOrgTable()->where('id', '=', $id)->first()->address;
                })
                ->addColumn('status', function ($list_data) {
                    if ($list_data->status == 'pending') {
                        return '<div class="badge badge-light-warning">Pending</div>';
                    } elseif ($list_data->status == 'accept') {
                        return '<div class="badge badge-light-success">Accept</div>';
                    } else {
                        return '<div class="badge badge-light-danger">Reject</div>';
                    }
                })
                ->addColumn('action', function ($list_data) {
                    return view('jobSeeker.inviteList.action_button', compact('list_data'));
                })
                ->rawColumns(['action', 'nameWithImage', 'email', 'address', 'phone', 'status'])
                ->tojson();
        }
        return view('jobSeeker.inviteList.index');
    }

    public function acceptReject(Request $request, $id)
    {
        try {
            if ($request->status == 'accept') {
                $data = Invite::findOrFail(decrypt($id));
                $data->update($request->except(['token']));
                Toastr::success('Accept Successfully!', 'success');
                return redirect()->back();
            } else {
                $data = Invite::findOrFail(decrypt($id));
                $data->update($request->except(['token']));
                Toastr::success('Reject Successfully!', 'success');
                return redirect()->back();
            }

        } catch (DecryptException $e) {
            Toastr::error('Something went wrong!', 'Error');
            return back();
        }


    }

    public function getSourcesOrgTable()
    {
        return DB::connection('sources')->table('organizations');
    }


}
