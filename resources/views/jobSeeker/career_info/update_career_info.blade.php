@extends('layouts.job_seeker')
@section('page-title','job Seeker Career Objective')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Career Objective')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Career Objective')}}</li>
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
                            <h4 class="mb-0">{{__('Update Career Objective')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
{{--                                <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"--}}
{{--                                   aria-controls="DataTables_Table_0" type="button" >--}}
{{--                                    <span>{{__('')}} <i class="fas fa-plus"></i></span>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <form action="{{route('jobSeeker.update.career-info',$info->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             @method('PUT')
                            <div class="row mt-2">
                                     <div class="form-group col-sm-12">
                                        <h5>Career And Application Objective</h5>
                                    </div>
                              </div>
                            <div class="row mt-2">
                                <div class="row col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <h5>Career Objective</h5>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" for="modern-last-name">Career Objective:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="4" cols="50" maxlength="750"  name="objective"  placeholder="write career objective.....">{{old('objective',$info->objective ?? '')}}</textarea>
                                    </div>
                                </div>
                                <div class="row col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <h5>Career Summary</h5>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" for="modern-last-name">Career Summary:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="4" name="career_summary" cols="50"  maxlength="750"  placeholder="write career summary....." style="height: 100px; width: 100%">{{old('career_summary',$info->career_summary ??'')}}</textarea>
                                    </div>
                                </div>
                                <div class="row col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <h5>Career Qualification</h5>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" for="modern-last-name">Special Qualification:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="4" name="special_qualification" cols="50" maxlength="750" placeholder="write special qualification....."  style="height: 100px; width: 100%">{{old('special_qualification',$info->special_qualification ?? '')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <button  class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                             aria-controls="DataTables_Table_0" type="submit">
                                        <span>{{__('Update')}}</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


