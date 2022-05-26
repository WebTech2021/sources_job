@extends('layouts.job_seeker')
@section('page-title','job Seeker portfolio Details')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Portfolio')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('portfolio Details')}}</li>
        </ol>
    </div>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('portfolio Details')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a class="btn btn-primary" href="{{route('jobSeeker.portfolio.index')}}">Portfolio List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="item-img col-sm-4">
                            <a href="#" class="rounded">
                                <img class="img-fluid p-1" style="height: 100%; width: 100%" src="{{asset(config('imagepath.portfolio').$portfolio->image)}}" alt="img-placeholder"/>
                            </a>
                        </div>
                        <div class="mt-2 col-sm-8">
                            <h4><b>Title:</b> {{$portfolio->title}}</h4>
                            <p><b>Status:</b>
                                @if($portfolio->status == 'active')
                                    <span class="text-success">Active</span>
                                @else
                                    <span>InActive</span>
                                @endif
                            </p>
                            <h5><b>Description:</b></h5>
                            <p> {{$portfolio->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush




