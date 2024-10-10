<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderDetailResource extends JsonResource
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
        return [
            'id' => $this->id,
            'advance' => $this->advance,
            'detail' => $this->detail ?? '',
            'img' => $fotosFiltered,
            'created_at' => $this->created_at
        ];
    }
}
