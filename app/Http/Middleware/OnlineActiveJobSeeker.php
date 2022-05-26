<?php

namespace App\Http\Middleware;

use App\Models\JobSeeker\JobSeeker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OnlineActiveJobSeeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('jobSeeker')->check()) {
            $jobSeeker = Auth::guard('jobSeeker')->user();
            $LastSeen = Carbon::parse($jobSeeker->last_seen_at)->addMinutes(1)->format('Y-m-d H:i:s');
            if (!$jobSeeker->last_seen_at || Carbon::now() > $LastSeen){
                $now = Carbon::now();
                $jobSeeker->update(['last_seen_at' => $now]);
            }
        }
        return $next($request);
    }
}
