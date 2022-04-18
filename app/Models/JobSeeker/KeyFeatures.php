<?php

namespace App\Models\JobSeeker;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyFeatures extends Model
{
    use HasFactory;
    protected $fillable=[
       'job_seeker_id','profession','education','experience','salary','job_type','available_status','location'
    ];
    public function category(){
        return $this->belongsTo(JobCategory::class,'profession');
    }
}
