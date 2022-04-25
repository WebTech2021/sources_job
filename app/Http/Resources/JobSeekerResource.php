<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class JobSeekerResource extends JsonResource
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
            'id' =>  encrypt($this->id),
            'image' =>  $this->image ? asset(config('imagepath.jobSeekerProfile') . $this->image) : null,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone_number,
            'email' => $this->email,
            'online_status' => $this->last_seen_at >= Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s') ? 'Online' : ($this->last_seen_at !== null ? $this->last_seen_at->diffForHumans() : '-'),
            'status' => $this->status,
        ];
    }
}
