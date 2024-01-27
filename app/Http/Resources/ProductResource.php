<?php

namespace App\Http\Resources;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'product_name' => (string) $this->product_name,
            'brand' => (string) $this->brand,
            'color' => (string) $this->color,
            'description' =>(string) $this->description,
            'product_price' => (float) $this->product_price,
            'images' => ProductImagesResource::collection($this->images)
        ];
    }
}
