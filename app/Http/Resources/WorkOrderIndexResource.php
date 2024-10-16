<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderIndexResource extends JsonResource
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
            'state' => $this->state,
            'priority' => $this->priority,
            'site' => $this->site->name,
            //'employees' => EmployeeWorkOrderResource::collection($this->employee_work_order),
            //'description' => $this->description ?? '',
            //'work_order_details' => WorkOrderDetailResource::collection($this->work_order_details),
            'date_time_closed' => $this->date_time_closed,
            //'description_closed' => $this->description_closed ?? '',
            //'img' => $fotosFiltered,
            'created_at' => $this->created_at,
            'date_time_finished' => $this->date_time_finished,
            'date_time_ejecuted' => $this->date_time_ejecuted,
        ];
    }
}
