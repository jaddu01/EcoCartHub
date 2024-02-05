<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'user_cart' => new UserResource($this->whenLoaded('user_cart')),
            'cart_items' => CartItemResource::collection('cart_items'),
            'status'=>$this->status
        ];
    }
}
