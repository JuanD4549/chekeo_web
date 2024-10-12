<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'img'=>$this->img1_url,
            'created_at'=>$this->created_at,
        ];
    }
}
