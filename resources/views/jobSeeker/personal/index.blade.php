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
                <li class="breadcrumb-item active"> Edit Personal info
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
                            <h4 class="mb-0"> <i class="fa fa-edit"></i> {{__('Edit My Info')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jobSeeker.profile.update',$jobSeeker->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                              <div class="media mb-2 mt-2">
                                  <div class="media">
                                      <a href="javascript:void(0);" class="mr-25">
                                          @if($jobSeeker->image)
                                              <img src="{{old('image',asset(config('imagepath.profile').$jobSeeker->image))}}"
                                                   id="blah"
                                                   class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                   height="90" width="90">
                                          @else
                                              <img src="{{asset('images/default.png')}}" id="blah"
                                                   class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                   height="90" width="90">
                                          @endif
                                      </a>
                                      <!-- upload and reset button -->
                                      <div class="media-body mt-75">
                                          <h4>{{$jobSeeker->first_name.' '.$jobSeeker->last_name}}</h4>
                                          <div class="col-12 d-flex mt-1 px-0">
                                              <label
                                                  class="btn btn-primary mr-75 mb-0 waves-effect waves-float waves-light"
                                                  for="change-picture">
                                                  <span class="d-none d-sm-block">{{__('Change')}} </span>
                                                  <input class="form-control imgInp" type="file"
                                                         id="change-picture" hidden=""
                                                         accept="image/png, image/jpeg, image/jpg"
                                                         name="image">
                                                  <span class="d-block d-sm-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-edit mr-0"><path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </span>
                                              </label>
                                              <button class="btn btn-outline-secondary d-none d-sm-block waves-effect">Remove</button>
                                          </div>
                                      </div>
                                  </div>
                            </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-first-name">First Name: <span style="color:red">*</span></label>
                                        <input type="text" id="modern-first-name" name="first_name" class="form-control" placeholder="your fast name" value="{{old('first_name',$jobSeeker->first_name)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Last Name: <span style="color:red">*</span></label>
                                        <input type="text" name="last_name" id="modern-last-name" class="form-control" placeholder="your last name" value="{{old('last_name',$jobSeeker->last_name)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Email: <span style="color:red">*</span></label>
                                        <input type="email" name="email" id="modern-last-name"  class="form-control" value="{{$jobSeeker->email}}" placeholder="email" readonly>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Phone Number: <span style="color:red">*</span></label>
                                        <input type="text" id="modern-last-name" name="phone_number" class="form-control" placeholder="phone number" value="{{old('phone_number',$jobSeeker->phone_number)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Father Name:</label>
                                        <input type="text" name="father_name" id="modern-last-name" class="form-control" placeholder="father name" required value="{{old('father_name',$jobSeeker->father_name)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Mother Name:</label>
                                        <input type="text" name="mother_name" id="modern-last-name" class="form-control" placeholder="mother name" required value="{{old('mother_name',$jobSeeker->mother_name)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Birth Date: <span style="color:red">*</span></label>
                                        <input type="date" name="dob" id="modern-last-name" class="form-control" placeholder="select date" value="{{old('dob',$jobSeeker->dob)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">NID: <span>(digits between:10-17)</span><span style="color:red">*</span></label>
                                        <input type="text" name="nid" id="modern-last-name" class="form-control" placeholder="nid number" required value="{{old('nid',$jobSeeker->nid)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Nationality:</label>
                                        <input type="text" name="nationality" id="nationality" class="form-control" placeholder="nationality" value="{{old('nationality',$jobSeeker->nationality)}}">
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Religion:</label>
                                        <input type="text" name="religion" id="religion" class="form-control" placeholder="religion"  value="{{old('religion',$jobSeeker->religion)}}">
                                    </div>

                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Gender:<span style="color:red">*</span></label>
                                        <select class="form-select form-control" id="basicSelect" name="gender">
                                            <option disabled selected>Select Option</option>
                                            <option value="male" {{old('gender',$jobSeeker->gender) == 'male'? 'selected':'' }}>Male</option>
                                            <option value="female" {{old('gender',$jobSeeker->gender) == 'female'? 'selected':'' }}>Female</option>
                                            <option value="other" {{old('gender',$jobSeeker->gender) == 'other'? 'selected':'' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="select2-basic">Languages: </label>
                                        <select class="js-example-tokenizer" multiple="multiple" name="language[]" id="languages" required>
                                            @if ($jobSeeker->language != "")
                                                @foreach(explode(',', $jobSeeker->language) as $language)
                                                    <option value="{{$language}}" selected >{{$language}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-1" style="width: 100%">
                                        <label class="form-label" for="select2-basic">Marital Status: </label>
                                        <div class="position-relative" data-select2-id="64">
                                            <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="marital_status" >
                                                <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                                <option value="single" {{ old('marital_status',$jobSeeker->marital_status) == 'single'? 'selected':'' }} >Single</option>
                                                <option value="married" {{ old('marital_status',$jobSeeker->marital_status)  == 'married'? 'selected':'' }}>Married</option>
                                                <option value="separated" {{ old('marital_status',$jobSeeker->marital_status)  == 'separated'? 'selected':'' }}>Separated</option>
                                                <option value="unmarried" {{ old('marital_status',$jobSeeker->marital_status)  == 'unmarried'? 'selected':'' }}>Unmarried</option>
                                                <option value="widowed"  {{ old('marital_status',$jobSeeker->marital_status)  == 'widowed'? 'selected':'' }}>Widowed</option>
                                            </select>
                                        </div>
                                    </div>
{{--                                    <div class="mb-1 col-md-3">--}}
{{--                                        <label class="form-label" for="modern-last-name">Experience: (In Years) <span style="color:red">*</span></label>--}}
{{--                                        <input type="number" id="modern-last-name" name="experience" class="form-control" placeholder="experience years" value="{{old('experience',$jobSeeker->experience)}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1 col-md-3">--}}
{{--                                        <label class="form-label" for="modern-last-name">Skills:<span style="color:red">*</span></label>--}}
{{--                                        <select class="js-example-tokenizer1" multiple="multiple" name="skills[]" id="" required>--}}
{{--                                            @if ($jobSeeker->skills != "")--}}
{{--                                                @foreach(explode(',', $jobSeeker->skills) as $skill)--}}
{{--                                                    <option value="{{$skill}}" selected >{{$skill}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="mb-1 col-md-3">
                                        <label for="email">{{__('Division')}}<span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="select_division" aria-invalid="false" name="division_id">
                                            <option selected disabled>Choose Division</option>
                                            @foreach($divisions as $division)
                                                <option value="{{$division->id}}" {{$division->id== old('division_id',$jobSeeker->division_id ?? '') ? 'selected' : ''}}>{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="divisionError"></div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label for="email">{{__('District')}}<span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="select_district" aria-invalid="false"
                                                name="district_id">
                                            <option selected disabled>Choose district</option>
                                            @foreach($districts as $district)
                                                <option value="{{$district->id}}" {{$district->id== old('district_id',$jobSeeker->district_id ?? '')? 'selected' : ''}}>{{$district->name}}</option>
                                            @endforeach()
                                        </select>
                                        <div class="invalid-feedback" id="districtError"></div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label for="email">{{__('Upazila')}}<span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="select_upazila" aria-invalid="false"
                                                name="upazila_id" >
                                            <option selected disabled>Choose Upazila</option>
                                            @foreach($upazilas as $upazila)
                                                <option value="{{$upazila->id}}" {{$upazila->id==old('upazila_id',$jobSeeker->upazila_id ?? '')? 'selected' : ''}}>{{$upazila->name}}</option>
                                            @endforeach()
                                        </select>
                                        <div class="invalid-feedback" id="upazilaError"></div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Post Code:</label>
                                        <input type="number" id="modern-last-name" name="post_code" class="form-control" placeholder="post code" value="{{old('post_code',$jobSeeker->post_code)}}">
                                    </div>
                                    <div class="col-md-3 mb-1"  style="width: 100%">
                                        <label class="form-label" for="select2-basic">Immediate Available: <span style="color:red">*</span></label>
                                        <div class="position-relative" data-select2-id="64">
                                            <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="available_status">
                                                <option value="" data-select2-id="2" selected disabled>Select Option</option>
                                                <option value="immediate_available" {{old('available_status',$jobSeeker->available_status) == 'immediate_available' ? 'selected':''}}>Active in Job</option>
                                                <option value="not_immediate_available" {{old('available_status',$jobSeeker->available_status) == 'not_immediate_available' ? 'selected':''}}> Available For New Job</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Permanent Address:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="1" name="p_address" cols="40" id="p_address" style="height: 60px;">{{old('p_address',$jobSeeker->p_address) }}</textarea>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Current Location:<span style="color:red">*</span></label>
                                        <textarea class="form-control address-height" rows="1" name="c_location" cols="40" id="c_location" style="height: 60px;">{{ old('c_location',$jobSeeker->c_location) }}</textarea>
                                    </div>
                                </div>
                            <div>
                                <hr>
                            </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">facebook link:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fab fa-facebook-f facebook-fa-icon"></i>
                                                </div>
                                            </div>
                                            <input class="form-control"  id="facebookUrl" value="{{old('facebook_url',$jobSeeker->facebook_url)}}" placeholder="https://www.facebook.com" name="facebook_url" type="text">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Twitter Link</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fab fa-twitter twitter-fa-icon"></i>
                                                </div>
                                            </div>
                                            <input class="form-control" id="twitterUrl" value="{{old('twitter_url',$jobSeeker->twitter_url)}}" placeholder="https://www.twitter.com" name="twitter_url" type="text">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="modern-last-name">Linkedin Link</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                                                </div>
                                            </div>
                                            <input class="form-control" id="linkedInUrl" value="{{old('linkedin_url',$jobSeeker->linkedin_url)}}" placeholder="https://www.linkedin.com" name="linkedin_url" type="text">
                                        </div>
                                    </div>
                                    <br>
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
                url: "{{route('jobSeeker.districts.get_by_division')}}?division_id=" + $(this).val(),
                method: 'GET',
                success: function (data) {
                    $('.district').show();
                    $('#select_district').html(data.html);
                }
            });
            $('#select_district').on('change', function () {

                //console.log($('#select_district').val());
                $.ajax({
                    url: "{{route('jobSeeker.upazila.get_by_district')}}?district_id=" + $(this).val(),
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
