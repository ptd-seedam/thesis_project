<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            abort(404);
        }
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'C_NAME' => 'required|string|max:255',
            'C_DESCRIPTION' => 'nullable|string',
        ]);

        $this->categoryService->createCategory($data);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo thể loại thành công');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            abort(404);
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'C_NAME' => 'required|string|max:255',
            'C_DESCRIPTION' => 'nullable|string',
        ]);

        $this->categoryService->updateCategory($id, $data);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thể loại thành công');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);

        return redirect()->route('admin.categories.index')->with('success', 'Xóa thể loại thành công');
    }
}
