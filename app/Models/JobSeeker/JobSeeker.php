<?php

namespace App\Models\JobSeeker;

use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Notifications\JobSeeker\EmailVerification;
use App\Notifications\JobSeeker\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobSeeker extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'image',
        'password',
        'email',
        'phone_number',
        'dob',
        'father_name',
        'mother_name',
        'gender',
        'marital_status',
        'nid',
        'nationality',
        'language',
        'country_id',
        'division_id',
        'district_id',
        'upazila_id',
        'post_code',
        'skills',
        'religion',
        'p_address',
        'c_location',
        'experience',
        'available_status',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'google_plus_url',
        'status',
        'last_seen_at'
    ];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime', 'last_seen_at' => 'datetime'];

    public function sendPasswordResetNotification($token)
    {
//        $delay = now()->addSeconds(5);
        $this->notify((new ResetPasswordNotification($token)));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerification());
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function career()
    {
        return $this->hasOne(KeyFeatures::class, 'job_seeker_id', 'id');
    }
    public function skill(){
        return $this->hasMany(Skills::class,'job_seeker_id','id');
    }
    public function objective(){
        return $this->hasOne(CareerAndApplicationInformation::class,'job_seeker_id','id');
    }
    public function experiences(){
        return $this->hasMany(jsExperience::class,'job_seeker_id','id');
    }
    public function education(){
        return $this->hasMany(jsEducation::class,'job_seeker_id','id');
    }
    public function reference(){
        return $this->hasMany(Reference::class,'job_seeker_id','id');
    }
    public function portfolio(){
        return $this->hasMany(Portfolio::class,'job_seeker_id','id');
    }

    public function featuredProfile()
    {
        return $this->morphOne(Feature::class, 'featurable');
    }

}
