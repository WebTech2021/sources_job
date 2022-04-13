@extends('layouts.job_seeker')
@push('styles')
@endpush
@section('breadcrumb')
    <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Home</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">My key Features</a>
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0"> <i class="fa fa-edit"></i> {{__('My Key Features')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('jobSeeker.key_features.create', $keyFeatures->id ?? null)}}" method="POST">
                            @csrf
{{--                            <div class="media mb-2 mt-2">--}}
{{--                                <div class="media">--}}
{{--                                    <a href="javascript:void(0);" class="mr-25">--}}
{{--                                        @if($jobSeeker->image)--}}
{{--                                            <img src="{{old('image',asset(config('imagepath.profile').$jobSeeker->image))}}"--}}
{{--                                                 id="blah"--}}
{{--                                                 class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"--}}
{{--                                                 height="90" width="90">--}}
{{--                                        @else--}}
{{--                                            <img src="{{asset('images/default.png')}}" id="blah"--}}
{{--                                                 class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"--}}
{{--                                                 height="90" width="90">--}}
{{--                                        @endif--}}
{{--                                    </a>--}}
{{--                                    <!-- upload and reset button -->--}}
{{--                                    <div class="media-body mt-75">--}}
{{--                                        <h4>{{$jobSeeker->first_name.' '.$jobSeeker->last_name}}</h4>--}}
{{--                                        <div class="col-12 d-flex mt-1 px-0">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row mt-2">
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-last-name">Job Type:<span style="color:red">*</span></label>
                                    <select class="select2 form-control" id="" name="job_type">
                                        <option disabled selected>Select Option</option>
                                        <option value="full_time" {{old('job_type',$keyFeatures->job_type) == 'full_time'? 'selected':'' }}>FullTime</option>
                                        <option value="par_time" {{old('job_type',$keyFeatures->job_type) == 'par_time'? 'selected':'' }}>ParTime</option>
                                        <option value="online" {{old('job_type',$keyFeatures->job_type) == 'online'? 'selected':'' }}>Online</option>
                                        <option value="internship" {{old('job_type',$keyFeatures->job_type) == 'internship'? 'selected':'' }}>Internship</option>
                                        <option value="contractual" {{old('job_type',$keyFeatures->job_type) == 'contractual'? 'selected':'' }}>Contractual</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-last-name">Education:<span style="color:red">*</span></label>
                                    <select class="select2 form-control" id="" name="education">
                                        <option disabled selected>Select Option</option>
                                        <option value="cse" {{old('education',$keyFeatures->education) == 'cse'? 'selected':'' }}>CSE</option>
                                        <option value="msc" {{old('education',$keyFeatures->education) == 'msc'? 'selected':'' }}>MSC</option>
                                        <option value="bba" {{old('education',$keyFeatures->education) == 'bba'? 'selected':'' }}>BBA</option>
                                        <option value="mba" {{old('education',$keyFeatures->education) == 'mba'? 'selected':'' }}>MBA</option>
                                        <option value="bsc" {{old('education',$keyFeatures->education) == 'bsc'? 'selected':'' }}>BSC</option>
                                        <option value="hsc" {{old('education',$keyFeatures->education) == 'hsc'? 'selected':'' }}>HSC</option>
                                        <option value="ssc" {{old('education',$keyFeatures->education) == 'ssc'? 'selected':'' }}>SSC</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label class="form-label" for="modern-last-name">Salary: <span style="color:red">*</span></label>
                                    <input type="number" id="modern-last-name" name="salary" class="form-control" placeholder="accepted salary" value="{{old('salary',$keyFeatures->salary)}}">
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label for="employment_status">{{__('Experience')}} (years)</label>
                                    <select class="form-control select2" name="experience"  required="">
                                        <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                        <option value="1" {{old('experience',$keyFeatures->experience) == '1'? 'selected' :' '}}>1 Year</option>
                                        @for ($i = 2; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{$i == old('experience',$keyFeatures->experience ) ?'selected':' ' }}>{{ $i }} Years</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label for="profession">{{__('Profession')}}<span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="" aria-invalid="false"
                                                name="profession">
                                        <option selected disabled>Select profession</option>
                                        @foreach($jobCategories as $jobCategory)
                                            <option value="{{$jobCategory->name}}" {{$jobCategory->name== old('profession',$keyFeatures->profession ?? '')? 'selected' : ''}}>{{$jobCategory->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="districtError"></div>
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label for="Location">{{__('Location')}}<span style="color: red;">*</span></label>
                                    <select class="form-control select2" id="select_district" aria-invalid="false"
                                            name="location">
                                        <option selected disabled>Select district</option>
                                        @foreach($districts as $district)
                                            <option value="{{$district->name}}" {{$district->name== old('location',$keyFeatures->location ?? '')? 'selected' : ''}}>{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="districtError"></div>
                                </div>
                                <div class="col-md-3 mb-1"  style="width: 100%">
                                    <label class="form-label" for="select2-basic">Available From: <span style="color:red">*</span></label>
                                    <div class="position-relative" data-select2-id="64">
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="available_status">
                                            <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                            <option value="this_month" {{old('available_from',$keyFeatures->available_status) == 'this_month' ? 'selected':''}}>This Month</option>
                                            <option value="next_month" {{old('available_from',$keyFeatures->available_status) == 'next_month' ? 'selected':''}}>Next Month</option>
                                            <option value="after_next_month" {{old('available_from',$keyFeatures->available_status) == 'after_next_month' ? 'selected':''}}>After Next Month</option>
                                        </select>
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
    <script>
        //image preview
        $("#change-picture").change(function () {
            readURL(this);
        });

        //image input
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $(document).ready(function () {
            // //select 2
            // $(".select2").select2({
            //     languages: true
            // });
            //tag select 2
            $(".js-example-tokenizer").select2({
                placeholder: 'Enter language',
                tags: true,
                tokenSeparators: [','],
                maximumSelectionLength: 5,
                allowClear: true
            });

            $(".js-example-tokenizer1").select2({
                placeholder: 'Enter skills',
                tags: true,
                tokenSeparators: [','],
                maximumSelectionLength: 5,
                allowClear: true
            });
        });
        $(document).ready(function () {
            $('.district').hide();
            $('.upazila').hide();
            $('.type').hide();
            $('#name').focusout(() => {
                $('#companyNameError').hide()
            })
            $('#phone_number').focusout(() => {
                $('#phoneError').hide()
            })
            $('#sector').focusout(() => {
                $('#sectorError').hide()
            })
            $('#type').focusout(() => {
                $('#typeError').hide()
            })
            $('#email-icon').focusout(() => {
                $('#emailError').hide()
            })
            $('#select_division').focusout(() => {
                $('#divisionError').hide()
            })
            $('#select_district').focusout(() => {
                $('#districtError').hide()
            })
            $('#select_upazila').focusout(() => {
                $('#upazilaError').hide()
            })
            $('#address').focusout(() => {
                $('#addressError').hide()
            })
            $('#login-password').focusout(() => {
                $('#passwordError').hide()
            })
            $('#password_confirmation').focusout(() => {
                $('#passwordConfirmationError').hide()
            })

        });
        $('#select_division').change(function () {
            $.ajax({
                url: "{{route('districts.get_by_division')}}?division_id=" + $(this).val(),
                method: 'GET',
                success: function (data) {
                    $('.district').show();
                    $('#select_district').html(data.html);
                }
            });
            $('#select_district').on('change', function () {

                //console.log($('#select_district').val());
                $.ajax({
                    url: "{{route('upazila.get_by_district')}}?district_id=" + $(this).val(),
                    method: 'GET',
                    success: function (data) {
                        $('.upazila').show();
                        $('#select_upazila').html(data.html);
                    }
                })
            });
        });
    </script>
@endpush
