{{--@extends('layouts.job_seeker')--}}
{{--@section('page-title','jobSeeker Experience Create')--}}
{{--@section('breadcrumb')--}}
{{--    <h2 class="content-header-title float-left mb-0">{{__('Create Experience')}}</h2>--}}
{{--    <div class="breadcrumb-wrapper">--}}
{{--        <ol class="breadcrumb">--}}
{{--            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>--}}
{{--            <li class="breadcrumb-item active">{{__('Experience Create')}}</li>--}}
{{--        </ol>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <section id="basic-datatable">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header border-bottom p-1">--}}
{{--                        <div class="head-label">--}}
{{--                            <h4 class="mb-0">{{__('Create Experience')}}</h4>--}}
{{--                        </div>--}}
{{--                        <div class="dt-action-buttons text-right">--}}
{{--                            <div class="dt-buttons d-inline-flex">--}}
{{--                                <a href="{{route('jobSeeker.experience.index')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"--}}
{{--                                   aria-controls="DataTables_Table_0" type="button">--}}
{{--                                    <span><i class="fas fa-backspace"></i> {{__('Back')}} </span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{route('jobSeeker.experience.store')}}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <div class="row mt-2">--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="experience_title">Designation: </label><span class="text-danger">*</span>--}}
{{--                                    <input class="form-control" name="designation" placeholder="designation"  type="text" id="designation" value="{{old('designation')}}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="experience_title">Department: </label><span class="text-danger">*</span>--}}
{{--                                    <input class="form-control" name="department" placeholder="department" type="text" id="department" value="{{old('department')}}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="company">Company Name:</label><span class="text-danger">*</span>--}}
{{--                                    <input class="form-control"  name="company_name" placeholder="company name" type="text" id="company_name" value="{{old('company_name')}}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="location">Company Location: </label><span class="text-danger">*</span>--}}
{{--                                    <input class="form-control"  name="company_location" placeholder="company location" type="text" id="location" value="{{old('company_location')}}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="experience">Area of Experiences: </label><span class="text-danger">*</span>--}}
{{--                                    <input class="form-control" name="experience" placeholder=" area of experience" type="text" id="experience" value="{{old('experience')}}" required>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="description">Responsibilities:</label>--}}
{{--                                    <textarea class="form-control textarea-sizing" rows="2" name="description" cols="3" id="description"  placeholder="Describe here...">{{ old('description')}}</textarea>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-12">Employment Period: </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label for="start_date">start Date:</label><span class="text-danger">*</span>--}}
{{--                                    <input class="form-control" type="date" id="startDate" autocomplete="off" name="start_date" value="{{ old('start_date') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4 end_date" id="demo">--}}
{{--                                    <label for="end_date">End Date:</label><span class="text-danger" id="requiredText">*</span>--}}
{{--                                    <input class="form-control" id="endDate" autocomplete="off" name="end_date" type="date" value="{{ old('end_date') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-sm-4">--}}
{{--                                    <label>{{__('Currently Working')}} <span style="color: red;">*</span></label>--}}
{{--                                    <div class="demo-inline-spacing">--}}
{{--                                        <div class="custom-control custom-radio">--}}
{{--                                            <input type="radio" name="currently_working" class="custom-control-input" id="customRadio8" value="yes">--}}
{{--                                            <label class="custom-control-label" for="customRadio8">{{__('Yes')}}</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="custom-control custom-radio">--}}
{{--                                            <input type="radio"  name="currently_working" class="custom-control-input" id="customRadio9" value="no">--}}
{{--                                            <label class="custom-control-label" for="customRadio9" >{{__('No')}}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="text-right">--}}
{{--                                <button type="submit" class="btn btn-primary" id="btnExperienceSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Submit</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $('#customRadio8').on('click', function (){--}}
{{--            $('.end_date').hide();--}}
{{--        })--}}
{{--        $('#customRadio9').on('click', function (){--}}
{{--            $('#demo').show();--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}




