<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictController extends Controller
{
    public function predict(Request $request): JsonResponse
    {
        // Validate đầu vào
        $validated = $request->validate([
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|min:1',
        ]);

        // Gửi đến server Flask
        $recommendationIds = $this->getRecommendationsFromPython($validated['book_ids']);

        // Nếu không có gợi ý → trả về 10 sách có lượt đọc cao nhất
        if (empty($recommendationIds)) {
            $fallbackBooks = Book::with(['author', 'publisher', 'category'])
                ->orderByDesc('B_TOTAL_READ')
                ->take(10)
                ->get();

            return response()->json([
                'success' => true,
                'data' => BookResource::collection($fallbackBooks),
                'meta' => [
                    'total' => $fallbackBooks->count(),
                    'note' => 'Trả về sách phổ biến do không có gợi ý',
                ],
            ]);
        }

        // Truy vấn sách theo danh sách được gợi ý
        $books = Book::with(['author', 'publisher', 'category'])
            ->whereIn('B_ID', $recommendationIds)
            ->get()
            ->sortBy(fn ($book) => array_search($book->B_ID, $recommendationIds))
            ->values();

        if (empty($books)) {
            $fallbackBooks = Book::with(['author', 'publisher', 'category'])
                ->orderByDesc('B_TOTAL_READ')
                ->take(10)
                ->get();

            return response()->json([
                'success' => true,
                'data' => BookResource::collection($fallbackBooks),
                'meta' => [
                    'total' => $fallbackBooks->count(),
                    'note' => 'Trả về sách phổ biến do không có gợi ý',
                ],
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
            'meta' => [
                'total' => $books->count(),
            ],
        ]);
    }

    protected function getRecommendationsFromPython(array $sessionItems): array
    {
        try {
            $response = Http::post('http://localhost:5000/predict', [
                'session_items' => $sessionItems,
            ]);

            if ($response->successful()) {
                return $response->json('recommendations') ?? [];
            }

            logger()->warning('Flask API không thành công', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        } catch (\Throwable $e) {
            logger()->error('Gọi Flask API thất bại', [
                'error' => $e->getMessage(),
            ]);

            return [];
        }
    }
}
