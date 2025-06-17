<?php

namespace App\Http\Controllers\Admin;

use App\FormRequest\Book\BookRequest;
use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Support\Str;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();

        return view('admin.books.index', compact('books'));
    }

    public function show(int $id)
    {
        $authors = $this->bookService->getAllAuthors();
        $categories = $this->bookService->getAllCategories();
        $publishers = $this->bookService->getAllPublishers();
        $id = (int) $id; // Ensure $id is an integer
        $book = $this->bookService->getBookById($id);
        if (! $book) {
            abort(404);
        }

        return view('admin.books.show', compact('book', 'authors', 'categories', 'publishers'));
    }

    public function create()
    {
        $authors = $this->bookService->getAllAuthors();
        $categories = $this->bookService->getAllCategories();
        $publishers = $this->bookService->getAllPublishers();

        return view('admin.books.create', compact('authors', 'categories', 'publishers'));
    }

    public function store(BookRequest $request)
    {
        $data = $request->validated();

        // Xử lý ảnh
        if ($request->hasFile('B_IMAGE')) {
            $imageName = time().'_'.Str::random(8).'.'.$request->B_IMAGE->getClientOriginalExtension();
            $request->B_IMAGE->move(public_path('images/books'), $imageName);
            $data['B_IMAGE'] = $imageName;
        } else {
            $data['B_IMAGE'] = 'default.png';
        }

        $this->bookService->createBook($data);

        return redirect()->route('admin.books.index')->with('success', 'Tạo sách thành công');
    }

    public function edit(int $id)
    {
        $book = $this->bookService->getBookById($id);
        if (! $book) {
            abort(404);
        }

        $authors = $this->bookService->getAllAuthors();
        $categories = $this->bookService->getAllCategories();
        $publishers = $this->bookService->getAllPublishers();

        return view('admin.books.edit', compact('book', 'authors', 'categories', 'publishers'));
    }

    public function update(BookRequest $request, int $id)
    {
        $data = $request->validated();

        // Xử lý ảnh (nếu có)
        if ($request->hasFile('B_IMAGE')) {
            $imageName = time().'_'.Str::random(8).'.'.$request->B_IMAGE->getClientOriginalExtension();
            $request->B_IMAGE->move(public_path('images/books'), $imageName);
            $data['B_IMAGE'] = $imageName;
        } else {
            unset($data['B_IMAGE']); // Không cập nhật ảnh nếu không có file mới
        }

        $this->bookService->updateBook($id, $data);

        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công');
    }

    public function destroy(int $id)
    {
        $this->bookService->deleteBook($id);

        return redirect()->route('admin.books.index')->with('success', 'Xóa sách thành công');
    }
}
