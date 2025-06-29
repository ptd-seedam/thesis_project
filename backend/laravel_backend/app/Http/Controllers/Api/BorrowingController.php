<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowingResource;
use App\Services\BookService;
use App\Services\BorrowingService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    public function store(Request $request, $bookId): JsonResponse
    {
        $user = JWTAuth::parseToken()->authenticate(); // 👈 ép buộc lấy user từ token
        $data = [
            'BR_DATE' => Carbon::parse($request->input('BR_DATE'))->format('Y-m-d H:i:s'),
            'BR_DUE_DATE' => Carbon::parse($request->input('BR_DUE_DATE'))->format('Y-m-d H:i:s'),
            'U_ID' => $user->U_ID,
            'B_ID' => $bookId,
        ];
        logger($request->all()); // ghi log các tham số được gửi lên
        logger(Auth::id()); // kiểm tra có đang đăng nhập không

        if ($this->bookService->decreaseBookStatus($data['B_ID'])) {
            $borrowing = $this->borrowingService->createBorrowing($data);

            return response()->json([
                'success' => true,
                'data' => new BorrowingResource($borrowing),
            ], 201);
        }

        return response()->json(['error' => 'Failed to decrease book status'], 400);
    }
}
