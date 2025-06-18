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
            'id' => $this->B_ID,
            'title' => $this->B_TITLE,
            'isbn' => $this->B_ISBN,
            'public_date' => $this->B_PUBLIC_DATE?->format('Y-m-d'),
            'total_copies' => $this->B_TOTAL_COPIES,
            'available_copies' => $this->B_AVAILABLE_COPIES,
            'rate' => (float) $this->B_RATE,
            'total_read' => $this->B_TOTAL_READ,
            'image_url' => $this->B_IMAGE ? asset('storage/'.$this->B_IMAGE) : null,

            // Relationships
            'author' => $this->whenLoaded('author', function () {
                return [
                    'id' => $this->author->A_ID,
                    'name' => $this->author->A_NAME,
                ];
            }),

            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->C_ID,
                    'name' => $this->category->C_NAME,
                ];
            }),

            'publisher' => $this->whenLoaded('publisher', function () {
                return [
                    'id' => $this->publisher->P_ID,
                    'name' => $this->publisher->P_NAME,
                    'address' => $this->publisher->P_ADDRESS,
                ];
            }),

            // Tính toán các giá trị phái sinh
            'is_available' => $this->B_AVAILABLE_COPIES > 0,
            'borrowed_copies' => $this->B_TOTAL_COPIES - $this->B_AVAILABLE_COPIES,
        ];
    }
}
