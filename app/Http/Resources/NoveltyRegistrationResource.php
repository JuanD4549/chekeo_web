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
        return [
            'id' => $this->id,
            //'status'=>$this->date_time_closed==null?false:true,
            'branche' => [
                'id' => $this->branche->id,
                'name' => $this->branche->name
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'user_notificad' => [
                'id' => $this->user_notificad->id,
                'name' => $this->user_notificad->name,
            ],
            'novelty' => [
                'id' => $this->novelty->id,
                'name' => $this->novelty->name,
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
