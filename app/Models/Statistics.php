<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
     protected $fillable=[
         'seeker_id','organization_id','download_at','view_at'
     ];
}
