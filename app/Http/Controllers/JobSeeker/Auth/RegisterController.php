<?php

namespace App\Http\Controllers\JobSeeker\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\jsRegistrationRequest;
use App\Models\JobSeeker\JobSeeker;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::JOBSEEKERHOME;

    public function __construct()
    {
        $this->middleware('guest:jobSeeker');
    }
    public function showRegistrationForm()
    {
        return view('JobSeeker.auth.registration');
    }
    public function register(jsRegistrationRequest $request)
    {
        $jobSeeker = JobSeeker::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => strtolower($request->email),
            'password' => bcrypt($request->password),
            'country_id' => 20,
        ]);
        $jobSeeker->save();
        event(new Registered($jobSeeker));
        Auth::guard('jobSeeker')->login($jobSeeker);
        Toastr::success("Registered Successfully", "Success");
        return redirect()->route('jobSeeker.verification.notice');

    }
}
