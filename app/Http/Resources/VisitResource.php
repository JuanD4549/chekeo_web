<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
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
            'name' => $this->name,
            'ci' => $this->ci,
            'cellphone' => $this->cellphone,
            'info_visit' => $this->info_visit,
            'img' => $fotosFiltered,
        ];
    }
}
