<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => encrypt($this->id),
            'type' => $this->featureData->type,
            'days' => $this->featureData->days,
            'remaining_days' => $this->when($this->expired!==null, Carbon::now()->diffInDays($this->expired, false)),
            'expire_date' => $this->when($this->expired!==null, Carbon::parse($this->expired)->format('D, d M Y')),
            'status' => $this->featureData->days,
            'cost' => $this->featureData->cost,
            'job' => new JobResource($this->featurable),
//            'job' => new JobResource($this->featurable())
        ];
    }
}
