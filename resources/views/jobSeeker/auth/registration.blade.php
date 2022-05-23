@extends('layouts.auth.job_seeker_auth')
@section('page-title','job-seeker Register')
@push('styles')
    <style type="text/css">
        #pageloader {
            background: rgba(255, 255, 255, 0.8);
            display: none;
            height: 100%;
            position: fixed;
            width: 100%;
            z-index: 9999;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        /*#pageloader img {*/
        /*    left: 50%;*/
        /*    margin-left: -32px;*/
        /*    margin-top: -32px;*/
        /*    position: absolute;*/
        /*    top: 50%;*/
        /*}*/

        .input-group-append:not(:last-child) .input-group-text {
            border-right: 1px solid #D8D6DE;
            border-top-right-radius: 0.357rem !important;
            border-bottom-right-radius: 0.357rem !important;
        }

        .input-group-merge .form-control:not(:last-child) {
            border-right: 1px solid #D8D6DE;
            border-top-right-radius: 0.357rem !important;
            border-bottom-right-radius: 0.357rem !important;
        }

        @media only screen and (max-width: 851px) {
            .login-title {
                font-size: 1.2rem !important;
            }
        }
    </style>
@endpush
@section('content')
    <!-- Login-->
{{--    <div id="pageloader">--}}
{{--        <img src="{{asset('images/pre-loader.gif')}}" alt="processing..."/>--}}
{{--    </div>--}}
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
    <div class="d-flex justify-content-center pl-2 ">
            <a class="" href="{{url('/')}}">
                <img style="height:50px;" src="{{ asset('admin/app-assets/images/ico/sources1.png') }}"/>
            </a>
        </div>
        <br>
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto mt-40 pl-5">
            <h2 class="card-title font-weight-bold mb-1 login-title"
                style="text-align: center; text-decoration: underline;" alt="Source Page Registration"
            ><b>Job Seeker Registration</b></h2>
            <p class="card-text mb-2">Please Register your account and start the Adventure.</p>
            @if ($errors->any())
                <div role="alert" aria-live="polite" aria-atomic="true" class="alert alert-primary">
                    <div class="alert-body font-small-2">
                        @foreach ($errors->all() as $error)
                            <p><small class="mr-50">{{ $error }}</small></p>
                        @endforeach
                    </div>
                </div>
            @endif
            <form class="auth-login-form mt-2" action="{{route('jobSeeker.register')}}" method="POST" id="registerSubmit">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">First Name<span style="color: red;">*</span></label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter first name"
                               value="{{ old('first_name') }}" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">Last Name<span style="color: red;">*</span></label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email<span style="color: red;">*</span></label>
                    <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"
                       title=""
                       data-original-title="Only accept valid email address"
                    ></i>
                    <div class="input-group input-group-merge">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
                               value="{{ old('email') }}" autocomplete="off" required
                        >
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone_number">Phone Number<span style="color: red;">*</span></label>
                    <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"
                       title="" data-original-title="Must be write 11 digits,Only accept numeric value,example: 016xxxxxxxx"
                    ></i>
                    <div class="input-group input-group-merge">
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone Number"
                               value="{{ old('phone_number') }}" autocomplete="off" required
                        >
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="login-password">Password<span style="color: red;">*</span>
                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"
                               title="" data-original-title="Minimum 8 characters, Maximum 20 characters"
                            ></i>
                        </label>
                    </div>

                    <div class="input-group input-group-merge form-password-toggle">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="lock"></i></span>
                        </div>
                        <input type="password" id="login-password" class="form-control" name="password"
                               placeholder="Password" autocomplete="off"
                        />
                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                                    data-feather="eye"
                                ></i></span></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="login-password">Retype Password<span style="color: red;">*</span>
                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"
                               title="" data-original-title="Minimum 8 characters, Maximum 20 characters"
                            ></i>
                        </label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="lock"></i></span>
                        </div>
                        <input type="password" id="password_confirmation" class="form-control"
                               name="password_confirmation" placeholder="Confirm Password" autocomplete="off" required
                        />
                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                                    data-feather="eye"
                                ></i></span></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="seller_terms_condition" id="remember-me"
                               type="checkbox" tabindex="3" autocomplete="off" required
                        />
                        <label class="custom-control-label" for="remember-me"> Accept All <a href="">Terms and
                                Condition</a>
                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"
                               title="" data-original-title="Must be check in or visit"
                            ></i>
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit" tabindex="4">Register</button>
            </form>
            <p class="card-text text-center mt-2"><span>Have an Account? </span><a href="{{ route('jobSeeker.login') }}"
                                                                                   class="router-link-active"
                                                                                   target="_self"
                ><span> Sign In</span></a>
            </p>

        </div>
        <footer class="footer footer-static footer-light text-center text-underline">
        </footer>
    </div>
    <!-- /Login-->

@endsection

