<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class JobDetailResource extends JsonResource
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
            'organization_name' => DB::table(config('database.connections.sources.database').'.organizations')->where('id','=',$this->organization_id)->first()->name,
            'job_title' => $this->job_title,
            'slug' => $this->slug,
            'vacancy' => $this->vacancy,
            'status' => $this->status,
            'to_date' => $this->to_date,

            'job_categories' => $this->job_categories,
            'job_location' => $this->job_location,
            'salary' => $this->salary,
            'salary_type' => $this->salary_type,
            'employment_status' => $this->employment_status,
            'job_responsibilities' => $this->job_responsibilities,
            'educational_requirements' => $this->educational_requirements,
            'additional_requirements' => $this->additional_requirements,
            'other_benefits' => $this->other_benefits,
            'job_context' => $this->job_context,
            'job_notes' => $this->job_notes,
            'age' => $this->age,
            'gender' => $this->gender,
            'min_experience' => $this->min_experience,
        ];
    }
}
