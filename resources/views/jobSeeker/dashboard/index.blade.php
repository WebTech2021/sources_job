@extends('layouts.job_seeker')
@push('styles')
@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">My Info</a>
                </li>
                <li class="breadcrumb-item active">My Dashboard
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <!--Bar Chart Start -->
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                        <div class="header-left">
                            <h4 class="card-title">My Profile</h4>
                        </div>
                        {{--                        <div class="header-right d-flex align-items-center mt-sm-0 mt-1">--}}
                        {{--                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>--}}
                        {{--                            <input type="text" class="form-control flat-picker border-0 shadow-none bg-transparent pr-0 flatpickr-input" placeholder="YYYY-MM-DD" readonly="readonly">--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="row" style="display: flex; justify-content: center;align-items: center">
                                <div class="">
                                    <div class="ticket-content ">
                                        <div class="row mx-12">
                                            <div class="ticket-sender-picture user-profile col-md-4 col-xl-4 col-sm-12 ">
                                                @if($jobSeeker->image)
                                                    <img src="{{asset(config('imagepath.profile').$jobSeeker->image ?? '')}}" style="height: 190px; width:185px; padding: 22px 2px;">
                                                @else
                                                    <img src="{{asset('images/default.png')}}" style="height: 196px; width:185px; padding: 22px 2px;">
                                                @endif
                                            </div>
                                            <div class=" col-md-8 col-xl-8 col-sm-12 " style="padding: 30px 60px">
                                                <div class="ticket-title">
                                                    <h2 class="text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                                  class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                            <circle cx="12" cy="7" r="4"></circle></svg>
                                                        {{$jobSeeker->first_name .' '. $jobSeeker->last_name }}
                                                    </h2>
                                                </div>
                                                <div class="font-weight-600 cell-phone">
                                                    <p class="text-red"><i class="fa fa-envelope"></i>&nbsp; {{$jobSeeker->email}}</p>
                                                    <p class="text-warning"><i class="fas fa-phone-square-alt"></i>&nbsp;
                                                        {{$jobSeeker->phone_number}}
                                                    </p>
                                                    <p class="location"><i class="fas fa-map-marker-alt"></i>&nbsp; {{$jobSeeker->p_address ?? 'Address not Available'}}
                                                    </p>
                                                </div>
                                                <div class="ticket-info">
                                                    <a class="btn btn-outline-primary waves-effect" href="{{route('jobSeeker.profileInfo.edit')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> &nbsp; Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row " style="padding: 30px 20px;">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="card" style="border:1px solid grey">
                                            <div class="card-header align-items-start pb-0">
                                                <div>
                                                    <h2 class="fw-bolder">100</h2>
                                                    <p class="card-text">Profile View</p>
                                                </div>
                                                <div class="avatar bg-light-primary p-50">
                                                    <div class="avatar-content">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor font-medium-5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 462px; height: 50px;"></div></div><div class="contract-trigger"></div></div></div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="card" style="border:1px solid grey">
                                            <div class="card-header align-items-start pb-0">
                                                <div>
                                                    <h2 class="fw-bolder">12</h2>
                                                    <p class="card-text">CV Download</p>
                                                </div>
                                                <div class="avatar bg-light-success p-50">
                                                    <div class="avatar-content">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check font-medium-5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 462px; height: 50px;"></div></div><div class="contract-trigger"></div></div></div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="card" style="border:1px solid grey">
                                            <div class="card-header align-items-start pb-0">
                                                <div>
                                                    <h2 class="fw-bolder">50</h2>
                                                    <p class="card-text">Invitation</p>
                                                </div>
                                                <div class="avatar bg-light-warning p-50">
                                                    <div class="avatar-content">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail font-medium-5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 462px; height: 50px;"></div></div><div class="contract-trigger"></div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bar Chart End -->

            <!-- Horizontal Bar Chart Start -->
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                        <div class="header-left">
                            <h4 class="card-title">Profile Setup Guidelines</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="height:400px"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas class="horizontal-bar-chart-ex chartjs chartjs-render-monitor" data-height="400" width="664" height="400" style="display: block; width: 664px; height: 400px;"></canvas></div>
                    </div>
                </div>
            </div>
            <!-- Horizontal Bar Chart End -->
        </div>
    </section>
@endsection

