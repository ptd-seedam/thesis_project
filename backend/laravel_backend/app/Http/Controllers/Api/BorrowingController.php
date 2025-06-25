<?php

namespace App\Http\Controllers\Api;
use App\FormRequest\Borrowing\BorrowingRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowingResource;
use App\Services\BookService;
use App\Services\BorrowingService;
use Illuminate\Http\JsonResponse;

class BorrowingController extends Controller
{
    protected BorrowingService $borrowingService;
    protected BookService $bookService;

    public function __construct(BorrowingService $borrowingService, BookService $bookService)
    {
        $this->borrowingService = $borrowingService;
        $this->bookService = $bookService;
    }

    public function index(): JsonResponse
    {
        $borrowings = $this->borrowingService->getAllBorrowings();

        return BorrowingResource::collection($borrowings)->response()->setStatusCode(200);
    }

    public function show(int $id): JsonResponse
    {
        $borrowing = $this->borrowingService->getBorrowingById($id);
        if (! $borrowing) {
            return response()->json(['error' => 'Borrowing not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new BorrowingResource($borrowing),
        ], 200);
    }

    public function store(BorrowingRequest $request): JsonResponse
    {
        $data = $request->validated();
        if ($this->bookService->decreaseBookStatus($data['B_ID'])) {
            $borrowing = $this->borrowingService->createBorrowing($data);
            return response()->json([
                'success' => true,
                'data' => new BorrowingResource($borrowing),
            ], 201);}

        return response()->json(['error' => 'Failed to decrease book status'], 400);
    }
}
