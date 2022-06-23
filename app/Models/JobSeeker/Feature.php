<?php

namespace App\Models\JobSeeker;

use App\Models\Admin\FeatureData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable=[
       'status','featurable_type', 'featurable_id','expired','feature_data_id'
    ];

    public function featurable(){
        return $this->morphTo('featurable');
    }
    public function featureData(){
        return $this->belongsTo(FeatureData::class, 'feature_data_id');
    }

}
