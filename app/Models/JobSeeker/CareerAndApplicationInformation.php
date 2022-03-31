<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerAndApplicationInformation extends Model
{
    use HasFactory;

    protected $fillable =[
       'employee_id',
       'objective',
       'present_salary',
        'expected_salary',
        'job_level',
        'job_nature',
        'pre_job_categories',
        'pre_job_location',
        'pre_organization_type',
        'career_summary',
        'special_qualification'
    ];

}
