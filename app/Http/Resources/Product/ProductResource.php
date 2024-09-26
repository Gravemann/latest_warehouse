<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandResouce;
use Illuminate\Http\JsonResponse;
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
            'id' => $this->id,
            'brand' => $this->brand->name,
            'brand_id' => $this->brand->id,
            'name' => $this->name,
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'image_path' => $this->image_path,
            'image_url' => $this->image_url,
            // 'created_at' => $this->created_at->diffForHumans(),
            // 'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
