<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => encrypt($this->id),
            'name' => $this->name,
            'slug' => $this->slug,
            'active_jobs_count'=> $this->whenLoaded('activeJobs', function (){
                return $this->job_count;
            }),
            'active_seeker_count'=> $this->whenLoaded('activeJobSeekers', function (){
                return $this->seeker_count;
            }),
        ];
    }
}
