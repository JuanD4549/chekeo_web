<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fotos = new FotoResource($request);
        //dd($fotos->resolve());
        $fotosFiltered = array_filter($fotos->resolve(), function ($item) {
            return $item !== null;
        });
        return [
            'id' => $this->id,
            'site' => new SiteResource($this->site),
            'employees' => EmployeeWorkOrderResource::collection($this->employee_work_order),
            'description' => $this->description ?? '',
            'priority' => $this->priority,
            'state' => $this->state,
            'work_order_details' => WorkOrderDetailResource::collection($this->work_order_details),
            'date_time_closed' => $this->date_time_closed ?? '',
            'description_closed' => $this->description_closed ?? '',
            'img' => $fotosFiltered,
            'created_at' => $this->created_at,
        ];
    }
}
