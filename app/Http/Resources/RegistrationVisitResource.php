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
        return [
            'id' => $this->id,
            'status'=>$this->date_time_out==null?false:true,
            'branche' => ['id' => $this->branche->id, 'name' => $this->branche->name],
            'user' => ['id' => $this->user->id, 'name' => $this->user->name],
            'visit' => ['id' => $this->visit->id, 'name' => $this->visit->name],
            'visit_car'=>['id'=>$this->visit_car->id, 'license_plate' => $this->visit_car->license_plate],
            'date_time_in'=>$this->date_time_in,
            'date_time_out'=>$this->date_time_out,
            'img'=>[$this->img1_url,$this->img2_url]
        ];
    }
}
