<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    protected $fillable =[
        'skill','job_seeker_id'
    ];
}
