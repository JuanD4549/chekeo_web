<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterRoundResource extends JsonResource
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
            'status'=>$this->date_time_closed==null?false:true,
            'branche' => [
                'id' => $this->branche->id,
                'name' => $this->branche->name
            ],
            'place' => [
                'id' => $this->place->id,
                'name' => $this->place->name
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'date_time_created'=>$this->created_at,
            'date_time_closed' => $this->date_time_closed,
            'detail_close' => $this->detail_close,
            'rounds' => RoundResource::collection($this->rounds),
            //dd($this->rounds->select('latitude','longitude')),
            'points'=>$this->rounds->select('latitude','longitude'),
        ];
    }
}
