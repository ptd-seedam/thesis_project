<?php
namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Services\BookService;

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
                'B_TOTAL_READ', 'B_TOTAL_COPIES', 'B_AVAILABLE_COPIES'
            ];

            if (in_array($sortField, $validSortFields)) {
                $query->orderBy($sortField, $sortDirection);
            }
        }
    }
}
