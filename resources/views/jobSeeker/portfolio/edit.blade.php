@extends('layouts.job_seeker')
@section('page-title','job Seeker portfolio')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Portfolio')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Edit portfolio')}}</li>
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
                            <h4 class="mb-0">{{__('Create portfolio')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a class="btn btn-primary" href="{{route('jobSeeker.portfolio.index')}}">Portfolio List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('jobSeeker.portfolio.update',encrypt($portfolio->id))}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row col-lg-12 mt-1">
                                <div class="form-group col-sm-4">
                                    <label for="title">Project Name:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="title" type="text" id="title" value="{{old('title',$portfolio->title)}}" placeholder="title" required="">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="title">Project Link:</label>
                                    <input class="form-control" name="link" type="text" id="link" value="{{old('link',$portfolio->link)}}" placeholder="project link">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="Role">My Role:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="role" type="text" id="role" value="{{old('role',$portfolio->role)}}" placeholder="my role" required="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label" for="modern-last-name">Project Info:<span style="color:red">*</span></label>
                                    <textarea class="form-control address-height" rows="3"  name="short_info" maxlength="200" cols="50" id="short_info" style="height: 100px; width: 100%" placeholder="write project info....." required="">{{old('short_info',$portfolio->short_info)}}</textarea>
                                </div>
                            </div>
                            <div class="text-right mt-2">
                                <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




