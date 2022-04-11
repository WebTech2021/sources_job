@extends('layouts.job_seeker')
@section('page-title','job details')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('jobs')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('job details')}}</li>
        </ol>
    </div>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('jobs Details')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                {{--                                <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"--}}
                                {{--                                   aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#default">--}}
                                {{--                                    <span>{{__('')}} <i class="fas fa-plus"></i></span>--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-8">
                                 <div class="card">
                                     <div class="card-body">
                                         <h5>Job Title:</h5>
                                          <p class="ml-2">{{$job_details->job_title ?? ''}}</p>
                                         <h5>Job Category:</h5>
                                         <p class="ml-2"> {{$job_details->job_categories ?? ''}}</p>
                                         <h5>Vacancy:</h5>
                                         <p class="ml-2"> {{$job_details->vacancy ?? ''}}</p>
                                         <h5>Job Context:</h5>
                                         <p class="ml-2"> {{$job_details->job_context ?? ''}}</p>
                                         <h5>Job status:</h5>
                                            {{-- <p class="ml-2"> {{ implode(', ',json_decode($job_details->employment_status)) }}</p>--}}
                                         <p class="ml-2"> {{$job_details->employment_status}}</p>
                                         <h5>Work Place:</h5>
                                            {{--  @if(implode(', ',json_decode($job_details->workplace)) == 'work_at_office')--}}
                                             @if($job_details->workplace == 'work_at_office')
                                                 <p class="ml-2"> Work at office</p>
                                             @else
                                                 <p class="ml-2"> Work from Home</p>
                                             @endif
                                         <h5>Work Experience:</h5>
                                         <p class="ml-2"> {{$job_details->min_experience ?? ''}}</p>
                                         <h5>Job Location:</h5>
                                             @if($job_details->job_location == 'outsideSide_dhaka')
                                                    <p class="ml-2">Outside Dhaka</p>
                                             @elseif($job_details->job_location == 'inside_dhaka')
                                                    <p class="ml-2">Inside Dhaka</p>
                                             @elseif($job_details->job_location == 'all_bangladesh')
                                                     <p class="ml-2">Anywhere in Bangladesh</p>
                                             @endif
                                         <h5>Salary:</h5>
                                          @if($job_details->salary == 'negotiable')
                                              <p class="ml-2">Negotiable</p>
                                            @else
                                                  <p class="ml-2"> {{$job_details->salary ?? ''}}</p>
                                           @endif
                                         <h5>Job Responsibilities:</h5>
                                          @foreach(json_decode($job_details->job_responsibilities) as $data)
                                              <ul>
                                                  <li>{{$data}}</li>
                                              </ul>
                                         @endforeach
                                         <h5>Educational Requirements:</h5>
                                         @foreach(json_decode($job_details->educational_requirements) as $data)
                                             <ul>
                                                 <li>{{$data}}</li>
                                             </ul>
                                         @endforeach
                                         <h5>Additional Requirements:</h5>
                                         @foreach(json_decode($job_details->additional_requirements) as $data)
                                             <ul>
                                                 <li>{{$data}}</li>
                                             </ul>
                                         @endforeach
                                         <h5>Other Benefits</h5>
                                         @foreach(json_decode($job_details->other_benefits) as $data)
                                             <ul>
                                                 <li>{{$data}}</li>
                                             </ul>
                                         @endforeach
                                         <h5>Before Apply:</h5>
                                         <p class="ml-2"> {{$job_details->job_notes ?? ''}}</p>
                                         <h5>Job Source:</h5>
                                         <p class="ml-2">sources.com.bd Online Job Posting.</p>
                                         <h5>Application Deadline:</h5>
                                         <p class="ml-2">{{$job_details->expire_date != null ? \Carbon\Carbon::parse($job_details->expire_date)->format('d M Y'):'no deadline issue'}}</p>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Job Summery</h3>
                                         <p><b>Published on:</b> {{$job_details->updated_at != null ? \Carbon\Carbon::parse($job_details->updated_at)->format('d M Y'):'no deadline issue'}}</p>
                                         <p><b>Job Title:</b> {{$job_details->job_title ?? ''}}</p>
                                        <p><b>Company Name:</b> {{$job_details->organization->name ?? ''}}</p>
                                         <p><b>Vacancy:</b> {{$job_details->vacancy ?? ''}}</p>
                                         <p><b>Employment Status:</b> {{$job_details->employment_status }}</p>
                                         <p><b>Gander:</b>
                                             @if($job_details->gander == 'male')
                                                Only Male can apply.
                                             @elseif($job_details->gander == 'female')
                                               Only Female can apply.
                                             @else
                                               Both Male & Female can apply.
                                             @endif
                                             </p>
                                         <p><b>Job Location:</b>
                                            @if($job_details->job_location == 'outsideSide_dhaka')
                                                Outside Dhaka
                                            @elseif($job_details->job_location == 'inside_dhaka')
                                                Inside Dhaka
                                            @elseif($job_details->job_location == 'all_bangladesh')
                                                Anywhere in Bangladesh
                                            @endif
                                            </p>
                                           <p><b>Application Deadline:</b> {{$job_details->expire_date != null ? \Carbon\Carbon::parse($job_details->expire_date)->format('d M Y'):'no deadline issue'}}</p>
                                           <div class="text-center">
                                               @if(!$job_details->checkApplication())
                                                   <form action="{{route('jobSeeker.job.apply',$job_details->id)}}" method="post">
                                                       @csrf
                                                       <button class="btn btn-success" type="submit">Apply Now</button>
                                                   </form>
                                               @else
{{--                                                   <a class="btn btn-secondary" type="button" disabled>Already Applied</a>--}}
                                                   <div class="badge badge-glow badge-danger">Already Applied</div>
                                               @endif
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
@push('scripts')

@endpush



