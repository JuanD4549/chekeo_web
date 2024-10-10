<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationVisitIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $visit = new VisitResource($this->visit);
        $employee = new EmployeeResource($this->employee);
        return [
            'id' => $this->id,
            'status' => $this->date_time_out == null ? false : true,
            'employee' => $employee['name'],
            'visit' => $visit['name'],
            'date_time_in' => $this->date_time_in,
            'date_time_out' => $this->date_time_out ?? '',
        ];
    }
}
