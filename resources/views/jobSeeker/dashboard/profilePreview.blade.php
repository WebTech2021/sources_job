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
                <li class="breadcrumb-item"><a href="#">My Info</a>
                </li>
                <li class="breadcrumb-item active"> Dashboard
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Cv Preview')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#default2">
                                    <span><i class="fas fa-download"></i> {{__('Download')}} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="container">
                                <div class="col-12 mt-5 mb-5">
                                    <div class="row">
                                        <div class="col-12  d-flex justify-content-between">
                                            <div class="left-content">
                                                <h2>{{$jobSeeker->first_name?? ''.' '.$jobSeeker->last_name??''}}</h2>
                                                <p class="p-0"><b>Address:</b> {{$jobSeeker->p_address ?? ''}}</p>
                                                <p class="p-0"><b>Mobile No:</b>{{$jobSeeker->phone_number ?? ''}}</p>
                                                <p class="p-0"><b>Email:</b> {{$jobSeeker->email ?? ''}}</p>
                                            </div>
                                             <div class="right-side">
                                                 @if($jobSeeker->image)
                                                  <img src="{{asset(config('imagepath.profile').$jobSeeker->image ?? '')}}"
                                                     class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                     height="170" width="150" style="border: 1px solid #bfbfbf;" alt="profile image">
                                                 @else
                                                     <img src="{{asset('images/default.png')}}"
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
                                                   {{$carerInfo->objective ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Career Summary:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{$carerInfo->career_summary ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Special Qualification:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{$carerInfo->special_qualification ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Skills:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
{{--                                                    {{$carerInfo->special_qualification ?? ''}}--}}
                                                </div>
                                            </div>
                                        </div>
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
                                                {{--<th><strong>Company Location</strong></th>--}}
                                                    <th><strong>Start Date</strong></th>
                                                    <th><strong>End Date</strong></th>
                                                {{--<th><strong>Currently Working</strong></th>--}}
                                                    <th><strong>Description</strong></th>
                                                </tr>
                                                @foreach($experiences as $data)
                                                    <tr class="td_style">
                                                        <td>{{$data->designation ?? ''}}</td>
                                                        <td>{{$data->department ?? ''}}</td>
                                                        <td>{{$data->company_name ?? ''}}</td>
                                                        <td>{{$data->experience ?? ''}}</td>
                                                        {{--<td>{{$data->company_location}}</td>--}}
                                                        <td>{{$data->start_date != null ? \Carbon\Carbon::parse($data->start_date)->format('d M Y'):'-'}}</td>
                                                        <td>{{$data->end_date != null ? \Carbon\Carbon::parse($data->end_date)->format('d M Y'): 'currently working'}}</td>
                                                        {{--<td>{{$data->currently_working ?? 'no'}}</td>--}}
                                                        <td>{{$data->description ?? ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
                                                @foreach($educations as $education)
                                                    <tr class="td_style">
                                                        <td>{{$education->degree_title ?? ''}}</td>
                                                        <td>{{$education->group ?? ''}}</td>
                                                        <td>{{$education->institute_name ?? ''}}</td>
                                                        <td>{{$education->education_board ?? ''}}</td>
                                                        <td>{{$education->result ?? ''}}</td>
                                                        <td>{{$education->passing_year ?? ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Accepted Opportunities:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <table style="width: 100%">
                                                <tbody>
                                                <tr>
                                                    <th class="name_style">Preferred Job Category</th>
                                                    <th class="colon_style">:</th>
                                                    <th>{{  ucfirst($carerInfo->pre_job_categories ?? ' ' )}}</th>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Looking For</td>
                                                    <th class="colon_style">:</th>
                                                    <td>
                                                        @if($carerInfo->job_level ?? '' == 'entry_level')
                                                            Entry Level
                                                        @elseif($carerInfo->job_level??'' == 'mid_level')
                                                            Mid Level
                                                        @elseif($carerInfo->job_level??'' == 'top_level')
                                                            Top Level
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Available For</td>
                                                    <th class="colon_style">:</th>
                                                    <td>
                                                        @if($carerInfo->job_nature ?? '' == 'full_time')
                                                            Full Time
                                                        @elseif($carerInfo->job_nature ?? '' == 'part_time')
                                                            Part Time
                                                        @elseif($carerInfo->job_nature ?? '' == 'contract')
                                                            Contract
                                                        @elseif($carerInfo->job_nature ?? '' == 'internship')
                                                            Internship
                                                        @elseif($carerInfo->job_nature ?? '' == 'freelance')
                                                            Freelance
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Present Salary</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        Tk.{{$carerInfo->present_salary ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Expected Salary</td>
                                                    <td class="colon_style">:</td>
                                                    <td width="66%" align="left">
                                                        Tk. {{$carerInfo->expected_salary ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Preferred Location</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        @if($carerInfo->pre_job_location ?? '' == 'inside_dhaka')
                                                            Inside Dhaka
                                                        @elseif($carerInfo->pre_job_location ?? '' == 'outside_dhaka')
                                                            Outside Dhaka
                                                        @elseif($carerInfo->pre_job_location ?? '' == 'all_bangladesh')
                                                            All Bangladesh
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name_style">Preferred Organization Types</td>
                                                    <td class="colon_style">:</td>
                                                    <td>
                                                        {{$carerInfo->pre_organization_type ?? ''}}
                                                    </td>
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

                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">Portfolios:</div>
                                        </div>
                                        <div class="mt-1 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @foreach($portfolios as $portfolio)
                                                       <ul>
                                                           <li>{{$portfolio->title}}</li>
                                                           <span>{{$portfolio->short_info}}</span><br>
                                                           <span>{{$portfolio->role}}</span><br>
                                                           <span>{{$portfolio->link}}</span>
                                                       </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 rounded" style="background-color: #bfbfbf">
                                            <div class="" style="color: #000; padding: 5px 3px;">References:</div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                @foreach($reference as $ref)
                                                <div class="col-md-4 mb-2">
                                                    <P>Name: <strong style="font-size:15px">{{$ref->name ?? ''}}</strong></P>
                                                    <P>Phone Number: {{$ref->phone_number ??''}}</P>
                                                    <P>profession: {{$ref->profession ??' '}}</P>
                                                    <P>Email: {{$ref->email ?? ' '}}</P>
                                                    <P>Address: {{$ref->address ?? ' '}}</P>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

