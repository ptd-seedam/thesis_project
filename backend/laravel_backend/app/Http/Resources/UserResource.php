<?php

namespace App\Http\Resources;

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
            'U_ID' => $this->U_ID,
            'U_NAME' => $this->U_NAME,
            'U_PHONE' => $this->U_PHONE,
            'U_ADDRESS' => $this->U_ADDRESS,
            'email' => $this->email,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Relationships
            'borrowings_count' => $this->whenCounted('borrowings'),
        ];
    }
}
