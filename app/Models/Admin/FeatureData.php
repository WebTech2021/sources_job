<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureData extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','days','cost'
    ];
}
