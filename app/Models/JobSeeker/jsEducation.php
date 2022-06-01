<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jsEducation extends Model
{
    use HasFactory;

    protected $fillable=[
        'job_seeker_id',
        'education_level',
        'degree_title',
        'phd_title',
        'education_board',
        'group',
        'institute_name',
        'result',
        'passing_year',
        'scale',
        'mark',
        'cgpa',

    ];
}
