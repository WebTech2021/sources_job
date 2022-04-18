<?php

namespace App\Models;


use App\Models\JobSeeker\JobSeeker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected  $fillable = [
        'job_seeker_id','job_id','organization_id','status'
    ];
    public  function job(){
        return $this->belongsTo(Jobs::class,'job_id');
    }

    public  function jobSeeker(){
        return $this->belongsTo(JobSeeker::class,'job_seeker_id');
    }
}
