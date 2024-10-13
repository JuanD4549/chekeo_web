<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceRoundIndexResource extends JsonResource
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
            'status' => false,
            'employee' => $this->employee->name ?? '',
            //'maintenance_round_details' => MaintenanceRoundDetailResource::collection($this->maintenance_round_details),
            'created_at' => $this->created_at,
            'date_time_closed' => null,

        ];
    }
}
