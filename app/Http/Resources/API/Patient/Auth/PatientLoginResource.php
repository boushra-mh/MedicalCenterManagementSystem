<?php

namespace App\Http\Resources\API\Patient\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientLoginResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'access-token'=>$this->access_token
        ];
    }
}
