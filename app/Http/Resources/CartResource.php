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
            'total_price'=>$this->total_price,
            'grand_total'=>$this->grand_total,
            // 'user' => new UserShortResource($this->whenLoaded('user')),
            'user' =>new UserShortResource($this->user),
            // 'products' => CartItemResource::collection($this->whenLoaded('items')),
            'products' => CartItemResource::collection($this->items),

        ];
    }
}
