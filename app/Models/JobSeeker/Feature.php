<?php

namespace App\Models\JobSeeker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable=[
       'type','status','featurable_type', 'featurable_id'
    ];

    public function featurable(){
        return $this->morphTo();
    }

}
