<?php

namespace App\Services;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepo->all();
    }

    public function findCategoryByName(string $name): ?Category
    {
        return $this->categoryRepo->findByName($name);
    }

    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepo->findById($id);
    }

    public function createCategory(array $data): ?Category
    {
        return $this->categoryRepo->create($data);
    }

    public function updateCategory(int $id, array $data): ?Category
    {
        return $this->categoryRepo->update($id, $data);
    }

    public function deleteCategory(int $id): bool
    {
        return $this->categoryRepo->delete($id);
    }
}
