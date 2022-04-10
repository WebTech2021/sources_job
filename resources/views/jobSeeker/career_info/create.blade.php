@extends('layouts.employee')
@section('page-title','Employee Career Info')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Career Info')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('employee.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Career Info')}}</li>
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
                            <h4 class="mb-0">{{__('create Career Info')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
{{--                               <a href="#" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"--}}
{{--                                                                   aria-controls="DataTables_Table_0" type="button" >--}}
{{--                                                                    <span>{{__('')}} <i class="fas fa-plus"></i></span>--}}
{{--                             </a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <form action="{{route('employee.info-store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PUT')--}}
                            <div class="row mt-2">
                                <div class="form-group col-sm-12">
                                    <h5>Career And Application information</h5>
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Job Level:</label><span class="text-danger">*</span>
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="job_level" required>
                                            <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                            <option value="entry_level" {{'entry_level'==old('job_level')?'selected':''}}>Entry Level</option>
                                            <option value="mid_level" {{'mid_level'==old('job_level')?'selected':''}}>Mid Level</option>
                                            <option value="top_level" {{'top_level'==old('job_level')?'selected':''}}>Top Level</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Job Nature:</label><span class="text-danger">*</span>
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="job_nature" required>
                                            <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                            <option value="full_time" {{'full_time'==old('job_nature')?'selected':''}}>Full Time</option>
                                            <option value="part_time" {{'part_time'==old('job_nature')?'selected':''}}>Part Time</option>
                                            <option value="contract" {{'contract'==old('job_nature')?'selected':''}}>Contract</option>
                                            <option value="internship" {{'internship'==old('job_nature')?'selected':''}}>Internship</option>
                                            <option value="freelance" {{'freelance'==old('job_nature')?'selected':''}}>Freelance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="degree_title">Present Salary:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="present_salary" value="{{old('present_salary')}}" type="text" id="present_salary" placeholder="present salary" required>
                                    <label for="degree_title">(TK/Month)</label>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="degree_title">Expected Salary:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="expected_salary" value="{{old('expected_salary')}}" type="text" id="expected_salary" placeholder="expected salary" required>
                                    <label for="degree_title">(TK/Month)</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label" for="modern-last-name">Career Objective:<span style="color:red">*</span></label>
                                    <textarea class="form-control address-height" rows="4" name="objective" cols="50" maxlength="750" placeholder="write career objective...." style="height: 100px; width: 100%">{{old('objective')}}</textarea>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group col-sm-12">
                                    <h5>Preferred Area</h5>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Preferred Job Categories:</label><span class="text-danger">*</span>
                                        <select class="max-length select2 form-control js-example-tokenizer1"  name="pre_job_categories[]" multiple>
{{--                                             <option value="" data-select2-id="2" selected disabled>Select one</option>--}}
                                            @foreach($job_categories as $job_category)
                                                <option value="{{$job_category->name}}" {{ (collect(old('pre_job_categories'))->contains($job_category->name)) ? 'selected':'' }}>{{$job_category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="degree_title">Preferred Job Location: </label><span class="text-danger">*</span>
                                    <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="pre_job_location">
                                        <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                        <option value="inside_dhaka"  {{'inside_dhaka'==old('pre_job_location')?'selected':''}}>Inside Dhaka</option>
                                        <option value="outsideSide_dhaka" {{'outsideSide_dhaka'==old('pre_job_location')?'selected':''}}>OutsideSide Dhaka</option>
                                        <option value="all_bangladesh" {{'all_bangladesh'==old('pre_job_location')?'selected':''}}>All Bangladesh</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="degree_title">Add your preferred organization type: </label><span class="text-danger">*</span>
                                      <select class="max-length select2 form-control js-example-tokenizer"  name="pre_organization_type[]" multiple>
                                             @foreach($categories as $category)
                                                  <option value="{{$category->name}}" {{ (collect(old('pre_organization_type'))->contains($category->name)) ? 'selected':'' }}>{{$category->name}}</option>
                                             @endforeach
                                        </select>
                                    <label for="degree_title">(max 5)</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="row col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <h5>Career Summary</h5>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" for="modern-last-name">Career Summary:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="4" name="career_summary" cols="50" maxlength="750" id="career_summary"  placeholder="write career summary...." style="height: 100px; width: 100%">{{old('career_summary')}}</textarea>
                                    </div>
                                </div>
                                <div class="row col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <h5>Career Qualification</h5>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" for="modern-last-name">Special Qualification:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="4" name="special_qualification" cols="50" maxlength="750" id="special_qualification" placeholder="write special qualification...." style="height: 100px; width: 100%">{{old('special_qualification')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <button  class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                             aria-controls="DataTables_Table_0" type="submit">
                                        <span>{{__('Submit')}}</span>
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
@push('scripts')
    <script src="{{asset('admin/app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <script>
        $(document).ready(function () {
            //select 2
            $(".select2").select2({});
            //tag select 2
            $(".js-example-tokenizer").select2({
                placeholder: 'Separate option by a comma',
                tokenSeparators: [','],
                maximumSelectionLength: 5,
                allowClear: true
            });
            $(".js-example-tokenizer1").select2({
                placeholder: 'Separate option by a comma',
                tokenSeparators: [','],
                maximumSelectionLength: 3,
                allowClear: true
            });
        });
    </script>
@endpush



