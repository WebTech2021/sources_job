@extends('layouts.job_seeker')
@push('styles')
    <style>
        .custom-image{
            margin-left: 20px;
            height: 150px;
            width: 150px;
            border: 1px solid #8d8d8d;
        }
        .td_style td{
            border-right:1px solid #666666;
            border-top:1px solid #666666;
            text-align:center;
            font-weight:normal;
            padding: 5px 5px;
        }
        .tr-style th{
            border-right:1px solid #666666;
            text-align:center;
        }
        .colon_style{
            font-weight:normal;
            text-align:center;
        }
        .name_style{
            padding-left:5px;
            font-weight:normal;
            text-align:left;
        }
    </style>
@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> Dashboard
                </li>
                <li class="breadcrumb-item"><a href="#">My Info</a>
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <section id="alerts-closable">
        <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="padding: 0.71rem 1rem !important;border: 1px solid transparent !important;">
                        <div class="alert-body text-center">
                            To include your profile in <b style="color: #0C1D2F">Promote</b> listed, You <b style="color: #0C1D2F">Must</b> have to fill all the information including <a href="{{route('jobSeeker.key.features')}}"><b style="color: #0C1D2F">KEY FEATURES</b></a> as well as <a href="{{route('jobSeeker.profileInfo.edit')}}"><b style="color: #0C1D2F">CV DETAILS</b></a>
                        </div>
                        <button type="button" class="close notice_close" id="notice_close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            </div>
        </div>
    </section>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-eye"></i>&nbsp;&nbsp;  {{__('CV Preview')}}</h4>
                        </div>
{{--                        {{$jobSeeker->latestFeature() && $jobSeeker->latestFeature()->status ===' expired' ? 'can': 'none'}}--}}
                             <div class="dt-action-buttons text-right">
                                   <span class="p-2">
                                    @if(is_null($jobSeeker->p_status))
                                        {{ ' '}}
                                    @else
                                         @if($jobSeeker->p_status->status == 'pending')
                                               Promote Status: <b style="color:black">Pending</b>
                                                @elseif($jobSeeker->p_status->status == 'expired')
                                               Promote Status: <b style="color:red">Expired</b>
                                                @elseif($jobSeeker->p_status->status == 'approved')
                                               Promote Status: <b style="color: green">Approved</b>
                                                @elseif($jobSeeker->p_status->status == 'unapproved')
                                               Promote Status: <b style="color:red">Unapproved</b>
                                                @else
                                               Promote Status: <b>No Promote Status available</b>
                                           @endif
                                   @endif
                                 </span>
                                 @if(($jobSeeker->latestFeature() && $jobSeeker->latestFeature()->status ==='expired') || !$jobSeeker->latestFeature())
                                     <div class="dt-buttons d-inline-flex">
                                         <form action="{{route('jobSeeker.make.feature',encrypt($jobSeeker->id))}}" method="post">
                                             @csrf
                                             <input type="text" name="status" value="pending" hidden>
                                             <button class="dt-button create-new btn btn-secondary ml-1 mr-1" type="submit"
                                                     style="width: 100%; border: none; outline:none;">
                                                 <div><i class="fa fa-check-circle"></i>&nbsp;&nbsp; {{__('Promote CV')}}</div>
                                             </button>
                                         </form>
                                     </div>
                                @elseif($jobSeeker->featuredProfile()->exists())
                                    <span class="badge badge-danger">Already Promote listed</span>
                                @else
                                    <div class="dt-buttons d-inline-flex">
                                        <form action="{{route('jobSeeker.make.feature',encrypt($jobSeeker->id))}}" method="post">
                                            @csrf
                                            <button class="dt-button create-new btn btn-secondary ml-1 mr-1" type="submit"
                                                    style="width: 100%; border: none; outline:none;">
                                                <div><i class="fa fa-pen"></i>&nbsp;&nbsp; {{__('Promote')}}</div>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('jobSeeker.seeker.pdf',encrypt($jobSeeker->id))}}" class="dt-button create-new btn btn-primary ml-1 mr-1" type="button" >
                                        <span><i class="fas fa-download"></i> {{__('Download CV')}} </span>
                                    </a>
                                </div>
                            </div>
{{--                        @endif--}}
                    </div>
                    <div class="card-body">
                            <div class="container">
                                <div class="col-12 mt-5 mb-5">
                                    <div class="row">
                                        <div class="col-12  d-flex justify-content-between">
                                            <div class="left-content">
                                                <h2>{{ucfirst($jobSeeker->first_name.' '.$jobSeeker->last_name ?? ' ')}}</h2>
                                                <p class="p-0"><b>Mobile No:</b> +88 {{$jobSeeker->phone_number ?? ''}}</p>
                                                <p class="p-0"><b>Email:</b> {{$jobSeeker->email ?? ''}}</p>
                                                <p class="p-0"><b>Address:</b> {{$jobSeeker->p_address ?? ''}}</p>
                                            </div>
                                             <div class="right-side">
                                                 @if($jobSeeker->image)
                                                  <img src="{{asset(config('imagepath.profile').$jobSeeker->image ?? '')}}"
                                                     class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                     height="170" width="150" style="border: 1px solid #bfbfbf;" alt="profile image">
                                                 @else
                                                     <img src="{{asset('images/dummy.jpg')}}"
                                                          class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                          height="170" width="150" style="border: 1px solid #bfbfbf;" alt="profile image">
                                                 @endif
                                             </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Career Objective:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                   {{$jobSeeker->objective->objective ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Career Summary:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{$jobSeeker->objective->career_summary ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Special Qualification:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{$jobSeeker->objective->special_qualification ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                        @if($jobSeeker->skill)
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Skills:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @foreach($jobSeeker->skill as $data)
                                                        <span>{{$data->skill ?? ' '}}</span>,
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($jobSeeker->experiences)
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Employment History:</div>
                                        </div>
                                        <div class="mt-1  col-12">
                                            <table style="padding-top:3px;border:1px solid #666666; word-break: break-word; width: 100%">
                                                <tbody>
                                                <tr class="tr-style">
                                                    <th><strong>Designation</strong></th>
                                                    <th><strong>Department</strong></th>
                                                    <th><strong>Company Name</strong></th>
                                                    <th><strong>Area of Experience</strong></th>
                                                    <th><strong>Start Date</strong></th>
                                                    <th><strong>End Date</strong></th>
                                                    <th><strong>Description</strong></th>
                                                </tr>
                                                @foreach($jobSeeker->experiences as $data)
                                                    <tr class="td_style">
                                                        <td>{{$data->designation ?? ''}}</td>
                                                        <td>{{$data->department ?? ''}}</td>
                                                        <td>{{$data->company_name ?? ''}}</td>
                                                        <td>{{$data->experience ?? ''}}</td>
                                                        {{--<td>{{$data->company_location}}</td>--}}
                                                        <td>{{$data->start_date != null ? \Carbon\Carbon::parse($data->start_date)->format('d M Y'):'-'}}</td>
                                                        <td>{{$data->end_date != null ? \Carbon\Carbon::parse($data->end_date)->format('d M Y'): 'Currently working'}}</td>
                                                        {{--<td>{{$data->currently_working ?? 'no'}}</td>--}}
                                                        <td>{{$data->description ?? '-'}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @if($jobSeeker->experiences)
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Academic Qualification:</div>
                                        </div>
                                        <div class="mt-1  col-12">
                                            <table style="padding-top:3px;border:1px solid #666666; word-break: break-word; width: 100%">
                                                <tbody>
                                                <tr class="tr-style">
                                                    <th><strong>Exam Title</strong></th>
                                                    <th><strong>Concentration / Major</strong></th>
                                                    <th><strong>Board</strong></th>
                                                    <th><strong>Institute</strong></th>
                                                    <th><strong>Result</strong></th>
                                                    <th><strong>Pas.Year</strong></th>
                                                </tr>
                                                @foreach($jobSeeker->education as $education)
                                                    <tr class="td_style">
                                                        <td>{{$education->degree_title ?? ''}}</td>
                                                        <td>{{$education->group ?? ''}}</td>
                                                        <td>{{$education->education_board ?? ''}}</td>
                                                        <td>{{$education->institute_name ?? ''}}</td>
                                                        <td>
                                                            @if($education->result == 'grade')
                                                                <p>CGPA-{{ $education->cgpa ?? ' ' }} out of {{$education->scale ?? ' '}}</p>
                                                            @elseif($education->result == '1st_class')
                                                                <p>First Division, Mark: {{$education->mark ?? ' '}}%</p>
                                                            @elseif($education->result == '2nd_class')
                                                                <p>Second Division, Mark: {{$education->mark ?? ' '}}%</p>
                                                            @elseif($education->result == '3rd_class')
                                                                <p>Third Division, Mark: {{$education->mark ?? ' '}}%</p>
                                                            @endif
                                                        </td>
                                                        <td>{{$education->passing_year ?? ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">My Expectation:</div>
                                        </div>
                                        <div class="mt-1 col-12">
                                            <table style="width: 100%">
                                                <tbody>
                                                <tr>
                                                    <th class="name_style">Preferred Job Category</th>
                                                    <th class="colon_style">:</th>
                                                    <th>
                                                        {{ $jobSeeker->career->category->name ?? '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Job Type</td>
                                                    <th class="colon_style">:</th>
                                                    <td>
                                                        {{$jobSeeker->career->job_type ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Last Education</td>
                                                    <th class="colon_style">:</th>
                                                    <td>
                                                        {{$jobSeeker->career->education ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Expected Salary (BDT)</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->career->salary ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Experience (years)</td>
                                                    <td class="colon_style">:</td>
                                                    <td width="66%" align="left">
                                                        {{$jobSeeker->career->experience ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Location</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->career->location ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Available From</td>
                                                    <td class="colon_style">:</td>
                                                    @if(is_null($jobSeeker->career))
                                                        <td></td>
                                                    @else
                                                    <td>
                                                        @if($jobSeeker->career->available_status == 'this_month'  )
                                                            This Month
                                                        @elseif($jobSeeker->career->available_status == 'next_month' )
                                                            Next Month
                                                        @elseif($jobSeeker->career->available_status == 'after_next_month')
                                                            After Next Month
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    @endif
                                                 </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Personal Details:</div>
                                        </div>
                                        <div class="mt-1 col-12">
                                            <table style="width: 100%">
                                                <tbody>
                                                <tr>
                                                    <th class="name_style">Father's Name</th>
                                                    <th class="colon_style">:</th>
                                                    <th>
                                                        {{ $jobSeeker->father_name ?? '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Mother's Name</td>
                                                    <th class="colon_style">:</th>
                                                    <td>
                                                        {{$jobSeeker->mother_name ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Date of Birth</td>
                                                    <th class="colon_style">:</th>
                                                    <td>
                                                        {{$jobSeeker->dob !=null ? \Carbon\Carbon::parse($jobSeeker->dob)->format('d M Y'):''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Gender</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->gender ??''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Marital Status</td>
                                                    <td class="colon_style">:</td>
                                                    <td width="66%" align="left">
                                                        {{$jobSeeker->marital_status ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Nationality</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->nationality ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">National Id No.</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->nid ?? ' '}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Religion</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->religion ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Permanent Address</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$jobSeeker->p_address ?? ' '}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Current Location</td>
                                                    <td class="colon_style">:</td>
                                                    <td >
                                                        {{$jobSeeker->c_location ?? ''}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @if(sizeof($jobSeeker->portfolio)>0)
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Portfolios:</div>
                                        </div>
                                        <div class="mt-1  col-12">
                                            <table style="padding-top:3px;border:1px solid #666666; word-break: break-word; width: 100%">
                                                <tbody>
                                                <tr class="tr-style">
                                                    <th><strong>Project Title</strong></th>
                                                    <th><strong>Project Info</strong></th>
                                                    <th><strong>My Role</strong></th>
                                                    <th><strong>Project Link</strong></th>
                                                </tr>
                                                @foreach($jobSeeker->portfolio as $portfolio)
                                                    <tr class="td_style">
                                                        <td>{{$portfolio->title ?? ''}}</td>
                                                        <td>{{$portfolio->short_info ?? ''}}</td>
                                                        <td>{{$portfolio->role ?? ''}}</td>
                                                        <td>{{$portfolio->link ?? ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif

                                        @if(sizeof($jobSeeker->reference)>0)
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">References:</div>
                                        </div>
                                        <div class="mt-1  col-12">
                                            <table style="padding-top:3px;border:1px solid #666666; word-break: break-word; width: 100%">
                                                <tbody>
                                                <tr class="tr-style">
                                                    <th><strong>Name</strong></th>
                                                    <th><strong>Phone Number</strong></th>
                                                    <th><strong>Institute</strong></th>
                                                    <th><strong>Profession</strong></th>
                                                    <th><strong>Email</strong></th>
                                                    <th><strong>Address</strong></th>
                                                </tr>
                                                @foreach($jobSeeker->reference as $ref)
                                                    <tr class="td_style">
                                                        <td>{{$ref->name ?? ''}}</td>
                                                        <td>{{$ref->phone_number ?? ''}}</td>
                                                        <td>{{$ref->institute ?? ''}}</td>
                                                        <td>{{$ref->profession ?? ''}}</td>
                                                        <td>{{$ref->email ?? ''}}</td>
                                                        <td>{{$ref->address ?? ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>
