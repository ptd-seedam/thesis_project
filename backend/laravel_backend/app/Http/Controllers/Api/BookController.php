<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(): JsonResponse
    {
        $books = $this->bookService->getAllBooks();

        return BookResource::collection($books)->response()->setStatusCode(200);
    }

    public function search($keyword): JsonResponse
    {
        $books = $this->bookService->searchBooks($keyword);

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
            'meta' => [
                'total' => $books->count(),
            ],
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $book = Book::with(['author', 'category', 'publisher'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new BookResource($book),
        ]);
    }

    public function allBooksOnAuthor(int $authorId): JsonResponse
    {
        $books = Book::with(['author', 'category', 'publisher'])
            ->where('A_ID', $authorId)
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
            'meta' => [
                'total' => $books->total(),
            ],
        ]);
    }

    public function allBooksOnCategory(int $categoryId): JsonResponse
    {
        $books = Book::with(['author', 'category', 'publisher'])
            ->where('C_ID', $categoryId)
            ->paginate(20);

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
                'B_TOTAL_READ', 'B_TOTAL_COPIES', 'B_AVAILABLE_COPIES',
            ];

            if (in_array($sortField, $validSortFields)) {
                $query->orderBy($sortField, $sortDirection);
            }
        }
    }

    public function getBookRandom(): JsonResponse
    {
        $books = $this->bookService->getBookRandom(10); // mặc định lấy 10 cuốn

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
            'meta' => [
                'total' => $books->count(),
            ],
        ]);
    }
}
