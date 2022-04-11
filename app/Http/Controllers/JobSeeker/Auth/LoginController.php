<?php

namespace App\Http\Controllers\JobSeeker\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::JOBSEEKERHOME;

    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1

    public function __construct()
    {
        $this->middleware('guest:jobSeeker')->except('logout');
    }

    protected function authenticated(Request $request,$user)
    {
        if ($user->status == 'blocked') {
            $this->guard()->logout();
            Toastr::error('Your account has been Restricted. Please,Contact with Admin', 'Error');
            return back();
//            return redirect()->route('jobSeeker.login')->with('error', 'Your account has been Restricted. Please,Contact with Admin');
        }
        session()->forget('loggedIn-from-admin');
    }


    public function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        return back()->with('second', $seconds);
    }
    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('jobSeeker.auth.login');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect()->route('jobSeeker.login');
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard()
    {
        return Auth::guard('jobSeeker');
    }


}
