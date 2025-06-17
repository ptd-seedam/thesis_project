<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'A_ID' => $this->A_ID,
            'A_NAME' => $this->A_NAME,
            'A_DESCRIPTION' => $this->A_DESCRIPTION,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
