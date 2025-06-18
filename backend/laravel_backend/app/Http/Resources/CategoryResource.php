<?php

// app/Http/Resources/CategoryResource.php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->C_ID,
            'name' => $this->C_NAME,
            'description' => $this->C_DESCRIPTION,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Relationships
            'books' => BookResource::collection($this->whenLoaded('books')),
            'books_count' => $this->whenCounted('books'),
        ];
    }
}
