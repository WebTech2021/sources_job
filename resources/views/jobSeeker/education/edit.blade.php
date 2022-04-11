@extends('layouts.job_seeker')
@section('page-title','JobSeeker Education update')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Update Education')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Education Update')}}</li>
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
                            <h4 class="mb-0">{{__('Update Education')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('jobSeeker.education.index')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button">
                                    <span><i class="fas fa-backspace"></i> {{__('Back')}} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('jobSeeker.education.update',encrypt($education->id))}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Level of Education:</label><span class="text-danger">*</span>
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_level" required="">
                                            <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                            <option value="secondary" {{old('secondary',$education->education_level == 'secondary') ? 'selected':''}}>Secondary</option>
                                            <option value="higher_secondary" {{old('higher_secondary',$education->education_level == 'higher_secondary') ? 'selected':''}}>Higher Secondary</option>
                                            <option value="diploma" {{old('diploma',$education->education_level == 'diploma') ? 'selected':''}}>Diploma</option>
                                            <option value="bachelor/honors" {{old('bachelor/honors',$education->education_level == 'bachelor/honors') ? 'selected':''}}>Bachelor/Honors</option>
                                            <option value="masters" {{old('masters',$education->education_level == 'masters') ? 'selected':''}}>Masters</option>
                                            <option value="phd" {{old('phd',$education->education_level == 'phd') ? 'selected':''}}>PhD (Doctor of Philosophy)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="degree_title">Degree Title:</label><span class="text-danger">*</span>
                                    <input class="form-control" name="degree_title" type="text" id="degree_title" value="{{old('degree_title',$education->degree_title)}}" required="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Board:</label><span class="text-danger">*</span>
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_board" required="">
                                            <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                            <option value="barishal" {{old('barishal',$education->education_board == 'barishal') ? 'selected':''}}>Barishal</option>
                                            <option value="chattogram" {{old('chattogram',$education->education_board == 'chattogram') ? 'selected':''}}>Chattogram</option>
                                            <option value="cumilla" {{old('cumilla',$education->education_board == 'cumilla') ? 'selected':''}}>Cumilla</option>
                                            <option value="dhaka" {{old('dhaka',$education->education_board == 'dhaka') ? 'selected':''}}>Dhaka</option>
                                            <option value="dinajpur" {{old('dinajpur',$education->education_board == 'dinajpur') ? 'selected':''}}>Dinajpur</option>
                                            <option value="jashore" {{old('jashore',$education->education_board == 'jashore') ? 'selected':''}}>Jashore</option>
                                            <option value="mymensingh" {{old('mymensingh',$education->education_board == 'mymensingh') ? 'selected':''}}>Mymensingh</option>
                                            <option value="rajshahi" {{old('rajshahi',$education->education_board == 'rajshahi') ? 'selected':''}}>Rajshahi</option>
                                            <option value="sylhet" {{old('sylhet',$education->education_board == 'sylhet') ? 'selected':''}}>Sylhet</option>
                                            <option value="madrasah" {{old('madrasah',$education->education_board == 'madrasah') ? 'selected':''}}>Madrasah</option>
                                            <option value="technical" {{old('technical',$education->education_board == 'technical') ? 'selected':''}}>Technical</option>
                                            <option value="bou" {{old('bou',$education->education_board == 'bou') ? 'selected':''}}>BOU</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="country">Concentration/Major/Group:</label><span class="text-danger">*</span>
                                    <input class="form-control" required="" name="group" type="text" id="group" value="{{old('result',$education->group)}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="institute">Institute Name:</label><span class="text-danger">*</span>
                                    <input class="form-control" required="" name="institute_name" type="text" id="institute_name" value="{{old('result',$education->institute_name)}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="result">Result:</label><span class="text-danger">*</span>
                                    <input class="form-control" required="" name="result" type="text" id="result" value="{{old('result',$education->result)}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="year">Passing Year:</label><span class="text-danger">*</span>
                                    <select class="form-control" id="" name="passing_year">
                                        {{ $last= date('Y')-121 }}
                                        {{ $now = date('Y') }}
                                        @for ($i = $now; $i >= $last; $i--)
                                            <option value="{{ $i }}"  {{$education->passing_year == $i ? 'selected':''}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



