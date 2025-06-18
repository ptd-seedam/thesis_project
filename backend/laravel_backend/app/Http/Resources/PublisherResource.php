<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->P_ID,
            'name' => $this->P_NAME,
            'address' => $this->P_ADDRESS,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Relationships
            'books' => BookResource::collection($this->whenLoaded('books')),
            'books_count' => $this->whenCounted('books'),
        ];
    }
}
