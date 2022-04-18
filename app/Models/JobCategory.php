<?php

namespace App\Models;

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
}
