<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'department' => new DepartmentResource($this->department),
            'branche' => new BrancheResource($this->branche),
            'calendar' => new CalendarResource($this->calendar),
            'user' => new UserResource($this->user),
            'name' => $this->name,
            'ci' => $this->ci,
            'blood_type' => $this->blood_type,
            'drive_license' => $this->drive_license ?? '',
            'email' => $this->email,
            'cellphone' => $this->cellphone ?? '',
            'phone' => $this->phone ?? '',
            'address' => $this->address ?? '',
            'country' => $this->country ?? '',
            'charge' => $this->charge ?? '',
            'province' => $this->province ?? '',
            'city' => $this->city ?? '',
            'date_in' => $this->date_in ?? '',
            'enterprise_mail' => $this->enterprise_mail ?? '',
            'enterprise_phone' => $this->enterprise_phone ?? '',
            'enterpriser_phone_ext' => $this->enterpriser_phone_ext ?? '',
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
