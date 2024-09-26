<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            // 'full_name' => $this->full_name,
            'contact_number' => '+' . $this->contact_number,
            'company' => $this->company,
            'image_path' => $this->image_path,
            'image_url' => $this->image_url,
        ];
    }
}
