<?php

namespace App\Http\Resources;

use App\Models\UserAddress;
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
        return [
            //'name' => $this->full_name,
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'phone_number' => $this->phone_number,
            'addresses' => UserAddressResource::collection($this->addresses),
        ];
    }
}
