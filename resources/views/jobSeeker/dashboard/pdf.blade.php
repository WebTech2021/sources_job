<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Some Random Title</title>
    <style>
        body{
            font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
            letter-spacing: -0.3px;
        }
        .nav-sidebar .nav-header:not(:first-of-type){ padding: 1.7rem 0rem .5rem; }
        .logo{ font-size: 50px; }
        .sidebar-collapse .brand-link .brand-image{ margin-top: -33px; }
        .table{
            width: 100%;
            border-collapse: collapse;
        }
        th{ text-align: left; padding: 0px; }
        td{ padding: 0px; font-size: 13px; }
        .row{ display: block; clear: both; }
        .text-right{ text-align: right; }
        .heading{
            background: #eee;
            padding: 10px;
        }
       .table .title {
            border: 1px solid #ddd;
            padding: 4px;
           text-align: center;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }


        address{ font-style: normal; }
    </style>
</head>
<body>
<div class="row invoice-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <td>
                            <h2>{{$seeker_details->first_name.' '.$seeker_details->last_name}}</h2>
                            <p>Mobile No:+88 {{$seeker_details->phone_number}}</p>
                            <p>Email: {{$seeker_details->email}}</p>
                            <p>Address: {{$seeker_details->p_address}}</p>
                        </td>
                        <td class="text-right">
{{--                            <strong>Date: 28 April 2020</strong>--}}
                            <img  height="165" width="140" src="{{$seeker_details->image ? ('images/profile/'.$seeker_details->image) ?? 'images/dummy.jpg'  : ('images/dummy.jpg')}}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-condensed table-hover"  style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Career Objective:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                    <div style="margin-left: 5px;">
                        <p>{{$seeker_details->objective->objective ?? ' '}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover"  style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Career Summary:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                    <div style="margin-left: 5px;">
                        <p>{{$seeker_details->objective->career_summary ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover"  style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Special Qualification:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                    <div style="margin-left: 5px;">
                        <p>{{$seeker_details->objective->special_qualification ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover"  style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Skills:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                     <div style="margin-left: 5px;">
                         @foreach($seeker_details->skill as $data)
                             <span>{{$data->skill ?? ' '}}</span>,
                         @endforeach
                     </div>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover"  style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Employment History:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                    <table class="table">
                        <tr>
                            <th class="title" style="width: 14.28%">Designation</th>
                            <th class="title" style="width: 14.28%">Department</th>
                            <th class="title" style="width: 14.28%">Company Name</th>
                            <th class="title" style="width: 14.28%">Area of Experience</th>
                            <th class="title" style="width: 14.28%">Start Date</th>
                            <th class="title" style="width: 14.28%">End Date</th>
                            <th class="title" style="width: 14.28%">Description</th>
                        </tr>
                        @foreach($seeker_details->experience as $data)
                        <tr>
                            <td class="title">{{$data->designation ?? ''}}</td>
                            <td class="title">{{$data->department ?? ''}}</td>
                            <td class="title">{{$data->company_name ?? ''}}</td>
                            <td class="title">{{$data->experience ?? ''}}</td>
                            <td class="title">{{$data->start_date != null ? \Carbon\Carbon::parse($data->start_date)->format('d M Y'):'-'}}</td>
                            <td class="title">{{$data->end_date != null ? \Carbon\Carbon::parse($data->end_date)->format('d M Y'): 'currently working'}}</td>
                            <td class="title">{{$data->description ?? ''}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover" style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Academic Qualification:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                    <table class="table">
                        <tr>
                            <th class="title" style="width: 16.66%">Exam Title</th>
                            <th class="title" style="width: 16.66%">Concentration / Major</th>
                            <th class="title" style="width: 16.66%">Board</th>
                            <th class="title" style="width: 16.66%">Institute</th>
                            <th class="title" style="width: 16.66%">Result</th>
                            <th class="title" style="width: 16.66%">Pas.Year</th> style="width: 16.66%;"
                        </tr>
                        @foreach($seeker_details->education as $education)
                            <tr>
                                <td class="title">{{$education->degree_title ?? ''}}</td>
                                <td class="title">{{$education->group ?? ''}}</td>
                                <td class="title">{{$education->institute_name ?? ''}}</td>
                                <td class="title">{{$education->education_board ?? ''}}</td>
                                <td class="title">{{$education->result ?? ''}}</td>
                                <td class="title">{{$education->passing_year ?? ''}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover" style="padding-bottom: 4px;">
                    <thead>
                    <tr>
                        <th class="heading">My Expectation:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="margin-left: 5px; margin-bottom: 15px">
                    <table style="width: 100%">
                        <tbody>
                        <tr>
                            <th class="name_style">Preferred Job Category</th>
                            <td class="colon_style">:</td>
                            <th>
                                {{ $seeker_details->career->category->name ?? ''}}
                            </th>
                        </tr>
                        <tr>
                            <td class="name_style">Job Type</td>
                            <th class="colon_style">:</th>
                            <td>
                                {{$seeker_details->career->job_type ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Last Education</td>
                            <th class="colon_style">:</th>
                            <td>
                                {{$seeker_details->career->education ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Expected Salary (BDT)</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->career->salary ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Experience (years)</td>
                            <td class="colon_style">:</td>
                            <td width="66%" align="left">
                                {{$seeker_details->career->experience ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Location</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->career->location ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Available From</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->career->available_status ?? ' '}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover" style="padding-bottom: 4px;">
                    <thead>
                    <tr>
                        <th class="heading">Personal Details:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="margin-left: 5px; margin-bottom: 15px">
                    <table style="width: 100%">
                        <tbody>
                        <tr>
                            <th class="name_style">Father's Name</th>
                            <td class="colon_style">:</td>
                            <th>
                                {{ $seeker_details->father_name ?? '' }}
                            </th>
                        </tr>
                        <tr>
                            <td class="name_style">Mother's Name</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->mother_name ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Date of Birth</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->dob !=null ? \Carbon\Carbon::parse($seeker_details->dob)->format('d M Y'):''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Gender</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->gender ??''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Marital Status</td>
                            <td class="colon_style">:</td>
                            <td width="66%" align="left">
                                {{$seeker_details->marital_status ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Nationality</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->nationality ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">National Id No.</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->nid ?? ' '}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Religion</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->religion ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Permanent Address</td>
                            <td class="colon_style">:</td>
                            <td>
                                {{$seeker_details->p_address ?? ' '}}
                            </td>
                        </tr>
                        <tr>
                            <td class="name_style">Current Location</td>
                            <td class="colon_style">:</td>
                            <td >
                                {{$seeker_details->c_location ?? ''}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover" style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">Portfolios:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px; margin-bottom: 15px">
                    <table class="table">
                        <tr>
                            <th class="title" style="width: 20%">Project Title</th>
                            <th class="title" style="width: 35%">Project Info</th>
                            <th class="title" style="width: 15%">My Role</th>
                            <th class="title" style="width: 30%">Project Link</th>
                        </tr>
                        @foreach($seeker_details->portfolio as $portfolio)
                            <tr>
                                <td class="title">{{$portfolio->title ?? ''}}</td>
                                <td class="title">{{$portfolio->short_info ?? ''}}</td>
                                <td class="title">{{$portfolio->role ?? ''}}</td>
                                <td class="title">{{$portfolio->link ?? ''}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover" style="padding-bottom: 5px;">
                    <thead>
                    <tr>
                        <th class="heading">References:</th>
                    </tr>
                    </thead>
                </table>
                <div class="mt-1 col-12" style="padding: 5px;">
                    <table class="table">
                        <tr>
                            <th class="title" style="width: 16.66%">Name</th>
                            <th class="title" style="width: 16.66%">Phone Number</th>
                            <th class="title" style="width: 16.66%">Institute</th>
                            <th class="title" style="width: 16.66%">Profession</th>
                            <th class="title" style="width: 16.66%">Email</th>
                            <th class="title" style="width: 16.66%">Address</th>
                        </tr>
                        @foreach($seeker_details->reference as $ref)
                            <tr>
                                <td class="title">{{$ref->name ?? ''}}</td>
                                <td class="title">{{$ref->phone_number ?? ''}}</td>
                                <td class="title">{{$ref->institute ?? ''}}</td>
                                <td class="title">{{$ref->profession ?? ''}}</td>
                                <td class="title">{{$ref->email ?? ''}}</td>
                                <td class="title">{{$ref->address ?? ''}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <br><br><br>
        <div>
            <small><small>NOTE: This CV Verified By Sources</small></small>
        </div>
    </div>
</div>
</body>
</html>
