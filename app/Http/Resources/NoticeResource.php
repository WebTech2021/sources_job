<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class NoticeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>encrypt($this->id),
            'subject' =>$this->subject,
            'data' =>$this->data,
            'created_at' =>$this->created_at->diffForHumans(),
            'sent_count' =>$this->when(Auth::guard('admin')->check(), $this->receiver()->count()),
        ];
    }
}
