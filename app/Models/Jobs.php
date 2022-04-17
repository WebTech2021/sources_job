<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $fillable =[
        'organization_id','job_title','vacancy','employment_status','gander',
        'workplace','job_location','min_experience','job_categories',
        'salary','salary_type','job_responsibilities','educational_requirements',
        'additional_requirements','other_benefits','job_context','expire_date','job_notes','status','slug'
    ];




}
