@extends('layouts.auth.job_seeker_auth')
@section('page-title','job-seeker login')
@section('content')

	<!-- Login-->
	<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
		<div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            <div class="d-flex justify-content-center mt-10">
                <a class="" href="{{url('/')}}">
                    <img style="height:50px;" src="{{ asset('admin/app-assets/images/ico/sources1.png') }}"/>
                </a>
            </div>
			<h1 class="card-title font-weight-bold mb-1" style="text-align: center;"><b>Job Seeker Login</b></h1>
			<p style="text-align: center;">------------------------------------------------------</p>
			<h2 class="card-title font-weight-bold mb-1">Welcome to Sources BD!</h2>
			<p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

            <div role="alert" aria-live="polite" aria-atomic="true" id="hide" class="alert alert-primary" style="display:none !important;">
                <div class="alert-body font-small-2">
                    <p> <small class="mr-50">Too many login attempts. Please try again in <span id="countdowntimer">120</span> Seconds</small> </p>
                </div>
            </div>
			@if ($errors->any())
				<div role="alert" aria-live="polite" aria-atomic="true" class="alert alert-primary">
					<div class="alert-body font-small-2">
						@foreach ($errors->all() as $error)
							<p><small class="mr-50">{{ $error }}</small></p>
						@endforeach
					</div>
				</div>
			@endif
			<form class="auth-login-form mt-2" action="{{ route('jobSeeker.login') }}" method="POST">
				@csrf
				<div class="form-group">
					<label class="form-label" for="login-email">Email<span style="color: red;">*</span></label>
					<div class="input-group input-group-merge">
						<div class="input-group-prepend">
							<span class="input-group-text"><i data-feather="mail"></i></span>
						</div>
						<input type="text" name="email" id="login-email" class="form-control" value="{{ old('email') }}" placeholder="Email" aria-describedby="login-email" autofocus tabindex="1" />
					</div>
				</div>
				<div class="form-group">
					<div class="d-flex justify-content-between">
						<label for="login-password">Password</label><a href="{{route('jobSeeker.password.request')}}"><small>Forgot Password?</small></a>
					</div>
					<div class="input-group input-group-merge form-password-toggle">
						<div class="input-group-prepend">
							<span class="input-group-text"><i data-feather="lock"></i></span>
						</div>
						<input type="password" id="login-password" class="form-control form-control-merge" name="password" placeholder="Password" aria-describedby="login-password" tabindex="2"  />
						<div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
					</div>
				</div>
				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} tabindex="3" />
						<label class="custom-control-label" for="remember"> Remember Me</label>
					</div>
				</div>
				<button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
			</form>
            <p class="card-text text-center mt-2"><span>New on our platform? </span><a href="{{ route('jobSeeker.register') }}" class="router-link-active" target="_self"><span> Create an account</span></a></p>
        </div>
	</div>
	<!-- /Login-->

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function (){
            var timeleft = '{{session('second')}}';
            console.log(timeleft)
            var downloadTimer = setInterval(function(){
                timeleft--;
                document.getElementById("countdowntimer").textContent = timeleft;
                if(timeleft <= 0){
                    $('#hide').hide();
                }else {
                    $('#hide').show();
                }
            },1000);
        })
    </script>
@endpush
