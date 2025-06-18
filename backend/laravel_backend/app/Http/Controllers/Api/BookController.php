<?php
namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Book::query()
            ->with(['author', 'category', 'publisher'])
            ->latest();

        // Filter theo các tiêu chí
        $this->applyFilters($query, $request);

        // Phân trang
        $perPage = $request->per_page ?? 20;
        $books = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
            'meta' => [
                'current_page' => $books->currentPage(),
                'total_pages' => $books->lastPage(),
                'total_items' => $books->total(),
            ],
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'keyword' => 'required|string|min:2',
        ]);

        $books = Book::with(['author', 'category', 'publisher'])
            ->where(function($query) use ($request) {
                $query->where('B_TITLE', 'like', '%'.$request->keyword.'%')
                      ->orWhere('B_ISBN', 'like', '%'.$request->keyword.'%')
                      ->orWhereHas('author', function($q) use ($request) {
                          $q->where('A_NAME', 'like', '%'.$request->keyword.'%');
                      })
                      ->orWhereHas('category', function($q) use ($request) {
                          $q->where('C_NAME', 'like', '%'.$request->keyword.'%');
                      })
                      ->orWhereHas('publisher', function($q) use ($request) {
                          $q->where('P_NAME', 'like', '%'.$request->keyword.'%');
                      });
            })
            ->paginate($request->per_page ?? 20);

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
            'meta' => [
                'total' => $books->total(),
            ],
        ]);
    }

    protected function applyFilters($query, Request $request): void
    {
        // Filter theo tác giả
        if ($request->has('author_id')) {
            $query->where('A_ID', $request->author_id);
        }

        // Filter theo thể loại
        if ($request->has('category_id')) {
            $query->where('C_ID', $request->category_id);
        }

        // Filter theo nhà xuất bản
        if ($request->has('publisher_id')) {
            $query->where('P_ID', $request->publisher_id);
        }

        // Filter theo trạng thái có sẵn
        if ($request->has('available')) {
            $query->where('B_AVAILABLE_COPIES', '>', 0);
        }

        // Sắp xếp
        if ($request->has('sort_by')) {
            $sortField = $request->sort_by;
            $sortDirection = $request->sort_dir ?? 'asc';

            $validSortFields = [
                'B_TITLE', 'B_PUBLIC_DATE', 'B_RATE',
                'B_TOTAL_READ', 'B_TOTAL_COPIES', 'B_AVAILABLE_COPIES'
            ];

            if (in_array($sortField, $validSortFields)) {
                $query->orderBy($sortField, $sortDirection);
            }
        }
    }
}
