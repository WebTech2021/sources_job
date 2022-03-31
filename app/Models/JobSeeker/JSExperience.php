<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JSExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'designation',
        'department',
        'company_name',
        'experience',
        'company_location',
        'start_date',
        'end_date',
        'currently_working',
        'description'
    ];

}
