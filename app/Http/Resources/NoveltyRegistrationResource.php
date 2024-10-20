<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoveltyRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //dd($this);
        $fotos = new FotoResource($request);
        //dd($fotos->resolve());
        $fotosFiltered = array_filter($fotos->resolve(), function ($item) {
            return $item !== null;
        });
        return [
            'id' => $this->id,
            'status' => $this->date_time_close == null ? false : true,
            //'status'=>$this->date_time_closed==null?false:true,
            'branche' => $this->branche->name ?? '',
            'security_guard' =>  $this->security_guard->name ?? '',
            'employee_notificad' => $this->employee->name ?? '',
            'novelty' => $this->novelty->name ?? '',
            'detail_created' => $this->detail_created,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'date_time_closed' => $this->date_time_close,
            'detail_closed' => $this->detail_closed ?? '',
            'img' => $fotosFiltered,
            'created_at' => $this->created_at,

        ];
    }
}
