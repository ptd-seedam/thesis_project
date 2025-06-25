<?php
// app/Http/Resources/BookResource.php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'B_ID' => $this->B_ID,
            'B_TITLE' => $this->B_TITLE,
            'B_PUBLIC_DATE' => $this->B_PUBLIC_DATE?->format('Y-m-d'),
            'B_TOTAL_COPIES' => $this->B_TOTAL_COPIES,
            'B_AVAILABLE_COPIES' => $this->B_AVAILABLE_COPIES,
            'B_RATE' => (float) $this->B_RATE,
            'B_TOTAL_READ' => $this->B_TOTAL_READ,
            'B_IMAGE' => $this->B_IMAGE ? asset($this->B_IMAGE) : null,

            // Relationships
            'author' => $this->whenLoaded('author', function () {
                return [
                    'A_ID' => $this->author->A_ID,
                    'A_NAME' => $this->author->A_NAME,
                ];
            }),

            'category' => $this->whenLoaded('category', function () {
                return [
                    'C_ID' => $this->category->C_ID,
                    'C_NAME' => $this->category->C_NAME,
                ];
            }),

            'publisher' => $this->whenLoaded('publisher', function () {
                return [
                    'P_ID' => $this->publisher->P_ID,
                    'P_NAME' => $this->publisher->P_NAME,
                    'P_ADDRESS' => $this->publisher->P_ADDRESS,
                ];
            }),

            // Tính toán các giá trị phái sinh
            'B_AVAILABLE_COPIES' => $this->B_AVAILABLE_COPIES > 0,
            'B_TOTAL_COPIES' => $this->B_TOTAL_COPIES - $this->B_AVAILABLE_COPIES,
        ];
    }
}
