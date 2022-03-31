<?php

namespace App\Http\Controllers\JobSeeker\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::JOBSEEKERHOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     */
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('JobSeeker.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * password broker for admin guard.
     */
    public function broker(){
        return Password::broker('job_seekers');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     */
    public function guard(){
        return Auth::guard('jobSeeker');
    }

}
