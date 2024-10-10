<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduledMaintenanceResource extends JsonResource
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
            'active' => $this->active,
            'employees' => ScheduledMaintenanceEmployeeResource::collection($this->scheduled_maintenance_employee),
            'site' => new SiteResource($this->site),
            'priority' => $this->priority,
            'description' => $this->description,
            'for_days' => $this->for_days,
            'in_day_time' => $this->in_day_time ?? [],
            'days' => $this->days ?? [],
            'months' => $this->months ?? [],
            'days_num' => $this->days_num ?? [],
            'the' => $this->the ?? [],
            'created_at' => $this->created_at,
        ];
    }
}
