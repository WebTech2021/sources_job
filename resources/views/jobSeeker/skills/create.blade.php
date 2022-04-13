@extends('layouts.job_seeker')
@section('page-title','job seeker skills')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Skills')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('create skill')}}</li>
        </ol>
    </div>
@endsection

@section('content')

@endsection




