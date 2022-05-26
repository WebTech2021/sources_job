<?php

namespace App\Models\JobSeeker;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable =[
       'job_seeker_id',
       'title',
       'link',
       'short_info',
       'role'
    ];
}
