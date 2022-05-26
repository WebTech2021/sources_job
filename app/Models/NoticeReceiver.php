<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeReceiver extends Model
{
    use HasFactory;
    protected $fillable = ['read_at'];

    public function notice()
    {
       return $this->belongsTo(Notice::class, 'notice_id');
    }

    public function markRead($id)
    {
        $this->find($id)->update(['read_at'=>now()]);
    }
}
