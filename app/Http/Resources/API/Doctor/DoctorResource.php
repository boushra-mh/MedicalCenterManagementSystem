<?php

namespace App\Http\Resources\API\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'specialties' => $this->specialties->pluck('name'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
