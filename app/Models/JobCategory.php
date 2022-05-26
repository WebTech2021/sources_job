<?php

namespace App\Models;

use App\Models\JobSeeker\JobSeeker;
use App\Models\JobSeeker\KeyFeatures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable=[
       'name','slug'
    ];

    public function jobs(){
        return $this->hasMany(Jobs::class,'job_categories');
    }

    public function activeJobs()
    {
        return $this->hasMany(Jobs::class,'job_categories')->where('status', '=', 'publish');
    }
    public function activeJobSeekers()
    {
        return $this->hasManyThrough(JobSeeker::class,KeyFeatures::class, 'profession', 'id','id','job_seeker_id');
    }
}
