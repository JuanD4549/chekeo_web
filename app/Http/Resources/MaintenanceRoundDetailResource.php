<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceRoundDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            ///'maintenance_round_id' => $this->maintenance_round_id,
            'site' => new SiteResource($this->site),
            'element_details' => ElementDetailResource::collection($this->element_detail),
            'created_at' => $this->created_at,
        ];
    }
}
