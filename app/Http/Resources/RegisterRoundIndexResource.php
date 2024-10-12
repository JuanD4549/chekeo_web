<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterRoundIndexResource extends JsonResource
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
            'status' => $this->date_time_closed == null ? false : true,
            'branche' => $this->branche->name ?? '',
            'place' => $this->place->name ?? '',
            'security_guard' => $this->security_guard->name ?? '',
            'created_at' => $this->created_at,
            'date_time_closed' => $this->date_time_closed,
            //'detail_close' => $this->detail_close ?? '',
            //'rounds' => RoundResource::collection($this->rounds),
            //dd($this->rounds->select('latitude','longitude')),
            //'points' => $this->rounds->select('latitude', 'longitude'),
        ];
    }
}
