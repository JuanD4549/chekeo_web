<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationVisitResource extends JsonResource
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
        $branche = new BrancheResource($this->branche);
        $employee = new EmployeeResource($this->employee);
        $visit_car = new VisitCarResource($this->visit_car);
        return [
            'id' => $this->id,
            'status' => $this->date_time_out == null ? false : true,
            'branche' => $branche['name'],
            'employee' => $employee,
            'visit' => new VisitResource($this->visit),
            'visit_car' => $visit_car['license_plate'],
            'date_time_in' => $this->date_time_in,
            'date_time_out' => $this->date_time_out ?? '',
            'img' => $fotosFiltered
        ];
    }
}
