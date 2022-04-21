<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'name' => $this->name,
            'avatar' => asset('/storage/images/admin/avatar') . $this->image,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'dob' => $this->dob ? date('d M Y', strtotime($this->dob)) : null,
        ];
    }
}
