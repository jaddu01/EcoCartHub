<?php

namespace App\Http\Resources;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price'=>$this->price,
            'product_price'=>$this->product_price,
            'product'=> new ProductResource($this->product),
        ];
    }
}
