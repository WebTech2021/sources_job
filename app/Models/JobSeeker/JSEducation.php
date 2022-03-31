<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JSEducation extends Model
{
    use HasFactory;
    protected $fillable=[
         'employee_id',
         'education_level',
         'degree_title',
         'education_board',
         'group',
         'institute_name',
         'result',
         'passing_year',
    ];

}



