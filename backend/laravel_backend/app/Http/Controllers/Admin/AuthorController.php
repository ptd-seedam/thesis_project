<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AuthorService;
use App\FormRequest\Authors\AuthorRequest;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    protected AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->getAllAuthors();
        return view('admin.authors.index', compact('authors'));
    }

    public function show($id)
    {
        $author = $this->authorService->getAuthorById($id);
        if (!$author) {
            abort(404);
        }
        return view('admin.authors.show', compact('author'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(AuthorRequest $request)
    {
        $data = $request->validated();

        $this->authorService->createAuthor($data);
        return redirect()->route('admin.authors.index')->with('success', 'Tạo tác giả thành công');
    }

    public function edit($id)
    {
        $author = $this->authorService->getAuthorById($id);
        if (!$author) {
            abort(404);
        }
        return view('admin.authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, $id)
    {
        $data = $request->validated();

        $this->authorService->updateAuthor($id, $data);
        return redirect()->route('admin.authors.index')->with('success', 'Cập nhật tác giả thành công');
    }

    public function destroy($id)
    {
        $this->authorService->deleteAuthor($id);
        return redirect()->route('admin.authors.index')->with('success', 'Xóa tác giả thành công');
    }
}
