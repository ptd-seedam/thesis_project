<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'BR_ID' => $this->BR_ID,
            'BR_DATE' => $this->BR_DATE,
            'BR_DUE_DATE' => $this->BR_DUE_DATE,
            'BR_RETURN_DATE' => $this->BR_RETURN_DATE,
            'BR_STATUS' => $this->BR_STATUS,
            'user' => new UserResource($this->whenLoaded('user')),
            'book' => new BookResource($this->whenLoaded('book')),
            'fine' => $this->whenLoaded('fine') ? new FineResource($this->fine) : null,
        ];
    }
}
