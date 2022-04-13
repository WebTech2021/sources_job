<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyFeatures extends Model
{
    use HasFactory;
    protected $fillable=[
       'job_seeker_id','profession','education','experience','salary','job_type','available_status','location'
    ];
}
