<?php

namespace App\Http\Resources\API\Appointment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
        'doctor' => [
            'id' => $this->doctor->id,
            'name' => $this->doctor->name,
        ],
        'date' => $this->date,
        'time' => $this->time,
        'status' => $this->status->value,
        'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
    ];

    }
}
