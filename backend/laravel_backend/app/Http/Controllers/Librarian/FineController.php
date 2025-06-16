<?php

namespace App\Http\Controllers\Librarian;

use App\FormRequest\Fine\FineRequest;
use App\Http\Controllers\Controller;

use App\Services\FineService;

class FineController extends Controller
{
    protected FineService $fineService;

    public function __construct(FineService $fineService)
    {
        $this->fineService = $fineService;
    }

    public function index()
    {
        $fines = $this->fineService->getAllFines();
        return view('librarian.fines.index', compact('fines'));
    }

    public function show($id)
    {
        $fine = $this->fineService->getFineById($id);
        if (!$fine) {
            abort(404);
        }
        return view('librarian.fines.show', compact('fine'));
    }

    public function create()
    {
        $users = $this->fineService->getAllUsers();
        $borrowings = $this->fineService->getAllBorrowings();
        return view('librarian.fines.create', compact('users', 'borrowings'));
    }

    public function store(FineRequest $request)
    {
        $data = $request->validated();

        $this->fineService->createFine($data);

        return redirect()->route('librarian.fines.index')->with('success', 'Tạo khoản phạt thành công');
    }

    public function edit($id)
    {
        $fine = $this->fineService->getFineById($id);
        if (!$fine) {
            abort(404);
        }
        $users = $this->fineService->getAllUsers();
        $borrowings = $this->fineService->getAllBorrowings();
        return view('librarian.fines.edit', compact('fine', 'users', 'borrowings'));
    }

    public function update(FineRequest $request, $id)
    {
        $data = $request->validated();

        $this->fineService->updateFine($id, $data);

        return redirect()->route('librarian.fines.index')->with('success', 'Cập nhật khoản phạt thành công');
    }

    public function destroy($id)
    {
        $this->fineService->deleteFine($id);

        return redirect()->route('librarian.fines.index')->with('success', 'Xóa khoản phạt thành công');
    }
}
