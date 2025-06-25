<?php

namespace App\Contracts;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function findbyTitle(string $title): ?Book;
    public function getAllAuthors(): Collection;
    public function getAllCategories(): Collection;
    public function getAllPublishers(): Collection;
    public function searchBooks(string $query): Collection;
    public function getAllBooks(): Collection;
    public function getBookById(int $id, array $columns = ['*'], array $relations = []): ?Book;
    public function create(array $data): ?Book;
    public function update(int $id, array $data): ?Book;
    public function delete(int $id): bool;
    public function all(array $columns = ['*'], array $relations = []): Collection;
    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Book;
    public function search(string $query): Collection;
    public function getBookByAuthor(int $authorId, array $columns = ['*'], array $relations = []): Collection;
    public function getBookByPublisher(int $publisherId, array $columns = ['*'], array $relations = []): Collection;
    public function getBookByCategory(int $categoryId): Collection;
    public function getBookRandom(): Collection;
}
