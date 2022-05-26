<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Jobs extends Model
{
    use HasFactory;
    protected $fillable =['status'
//        'organization_id','job_title','vacancy','employment_status','gander',
//        'workplace','job_location','min_experience','job_categories',
//        'salary','salary_type','job_responsibilities','educational_requirements',
//        'additional_requirements','other_benefits','job_context','to_date','job_notes','status','slug','from_date'
    ];

    public function checkApplication(){
        return JobApplication::where('job_seeker_id', auth()->user()->id)->where('job_id',$this->id)->exists();
    }

    public function category(){
        return $this->belongsTo(JobCategory::class, 'job_categories', 'id');
    }



}
