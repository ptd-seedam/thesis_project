<?php

namespace App\Http\Controllers\Librarian;

use App\FormRequest\Borrowing\BorrowingRequest;
use App\Http\Controllers\Controller;
use App\Services\BookService;
use App\Services\BorrowingService;

class BorrowingController extends Controller
{
    protected BorrowingService $borrowingService;

    protected BookService $bookService;

    public function __construct(BorrowingService $borrowingService, BookService $bookService)
    {
        $this->borrowingService = $borrowingService;
        $this->bookService = $bookService;
    }

    public function index()
    {
        $borrowings = $this->borrowingService->getAllBorrowings();

        return view('librarian.borrowings.index', compact('borrowings'));
    }

    public function show($id)
    {
        $borrowing = $this->borrowingService->getBorrowingById($id);
        if (! $borrowing) {
            abort(404);
        }

        return view('librarian.borrowings.show', compact('borrowing'));
    }

    public function create()
    {
        $defaultValues = [
            'BR_DATE' => now()->format('Y-m-d'),
            'BR_DUE_DATE' => now()->addWeek()->format('Y-m-d'),
            'BR_STATUS' => 'Đang mượn',
        ];

        $users = $this->borrowingService->getAllUsers();
        $books = $this->borrowingService->getAllBooks();
        if ($users->isEmpty() || $books->isEmpty()) {
            return redirect()->route('librarian.borrowings.index')->with('error', 'Không có người dùng hoặc sách nào để mượn');
        }

        return view('librarian.borrowings.create', compact('users', 'books'));
    }

    public function store(BorrowingRequest $request)
    {
        $data = $request->validated();
        if ($this->bookService->decreaseBookStatus($data['B_ID'])) {
            $this->borrowingService->createBorrowing($data);

            return redirect()->route('librarian.borrowings.index')->with('success', 'Tạo lượt mượn thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật trạng thái sách thất bại');
        }
    }

    public function edit($id)
    {
        $borrowing = $this->borrowingService->getBorrowingById($id);
        if (! $borrowing) {
            abort(404);
        }
        $users = $this->borrowingService->getAllUsers();
        $books = $this->borrowingService->getAllBooks();
        if ($users->isEmpty() || $books->isEmpty()) {
            return redirect()->route('librarian.borrowings.index')->with('error', 'Không có người dùng hoặc sách nào để mượn');
        }

        return view('librarian.borrowings.edit', compact('borrowing', 'users', 'books'));
    }

    public function update(BorrowingRequest $request, $id)
    {
        $data = $request->validated();
        $borrowing = $this->borrowingService->getBorrowingById($id);
        if ($borrowing->B_ID != $data['B_ID']) {
            $this->bookService->increaseBookStatus($borrowing->B_ID);
            $this->bookService->decreaseBookStatus($data['B_ID']);
        }

        $this->borrowingService->updateBorrowing($id, $data);

        return redirect()->route('librarian.borrowings.index')->with('success', 'Cập nhật lượt mượn thành công');
    }

    public function destroy($id)
    {
        $borrowing = $this->borrowingService->getBorrowingById($id);
        $this->bookService->increaseBookStatus($borrowing->B_ID);
        $this->borrowingService->deleteBorrowing($id);

        $this->borrowingService->deleteBorrowing($id);

        return redirect()->route('librarian.borrowings.index')->with('success', 'Xóa lượt mượn thành công');
    }
}
