<?php

namespace App\Http\Resources;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //dd($this->employee);
        $enterprise = Enterprise::select('name')->find(1);
        if ($this->roles[0]->name == 'super_admin') {
            return [
                'enterprise' => $enterprise->name,
                'name' => $this->name ?? '',
                'ci' => '0000000000',
                'charge' => 'super_admin',
                'img' => $this->avatar_url ?? '',
            ];
        } else {
            $employee = $this->employee;
            return [
                'enterprise' => $enterprise->name,
                'name' => $employee->name ?? '',
                'ci' => $employee->ci ?? '',
                'charge' => $employee->charge ?? '',
                'img' => $this->avatar_url ?? '',
            ];
        }
    }
}
