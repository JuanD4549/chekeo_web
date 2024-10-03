<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $roles = RolesResource::collection($this->roles);
        $rol = '';
        if (count($roles) > 0) {
            $rol = $roles[0]->name;
        }
        if ($rol == 'security_guard') {
            $data = '';
        }
        return [
            'id' => $this->id,
            'name_user' => $this->name,
            'rol' => $rol,
            'data' => '',
        ];
    }
}
