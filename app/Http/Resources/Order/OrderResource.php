<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'client' => $this->client->name . ' ' . $this->client->surname,
            'client_contact_number' => $this->client->contact_number,
            'brand' => $this->product->brand->name,
            'product' => $this->product->name,
            'purchase_price' => $this->product->purchase_price,
            'sale_price' => $this->product->sale_price,
            'stock' => $this->product->quantity,
            'quantity' => $this->quantity,
            'profit' => ($this->product->sale_price - $this->product->purchase_price) * $this->quantity,
            'confirmed' => $this->confirmed,
        ];
    }
}
