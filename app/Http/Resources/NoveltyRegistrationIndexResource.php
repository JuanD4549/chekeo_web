<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoveltyRegistrationIndexResource extends JsonResource
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
            'status' => $this->date_time_close == null ? false : true,
            //'status'=>$this->date_time_closed==null?false:true,
            'branche' => $this->branche->name ?? '',
            'security_guard' =>  $this->security_guard->name ?? '',
            'employee_notificad' => $this->employee->name ?? '',
            'novelty' => $this->novelty->name ?? '',
            //'detail_created' => $this->detail_created,
            //'latitude' => $this->latitude,
            //'longitude' => $this->longitude,
            'date_time_closed' => $this->date_time_close,
            //'detail_closed' => $this->detail_close??'',
            //'imgs' => [$this->img1_url, $this->img2_url, $this->img3_url, $this->img4_url]
        ];;
    }
}
