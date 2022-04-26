<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class JobResource extends JsonResource
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
            'organization_name' => DB::table(config('database.connections.sources.database').'.organizations')->where('id','=',$this->id)->first()->name,
            'title' => $this->job_title,
            'slug' => $this->slug,
            'vacancy' => $this->vacancy,
            'status' => $this->status,
            'end_date' => $this->to_date,
        ];
    }
}
