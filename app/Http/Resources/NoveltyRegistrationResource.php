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
        return [
            'id' => $this->id,
            'status'=>$this->date_time_close==null?false:true,

            //'status'=>$this->date_time_closed==null?false:true,
            'branche' => [
                'id' => $this->branche->id,
                'name' => $this->branche->name
            ],
            'user' => [
                'id' => $this->user->id??0,
                'name' => $this->user->name??0,
            ],
            'user_notificad' => [
                'id' => $this->user_notificad->id??0,
                'name' => $this->user_notificad->name??0,
            ],
            'novelty' => [
                'id' => $this->novelty->id??0,
                'name' => $this->novelty->name??0,
            ],
            'detail_created' => $this->detail_created,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'date_time_close' => $this->date_time_close,
            'detail_closed' => $this->detail_close,
            'imgs' => [$this->img1_url, $this->img2_url, $this->img3_url, $this->img4_url]
        ];
    }
}
