<?php

namespace App\Services;

use App\Contracts\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{
    protected AuthorRepositoryInterface $authorRepo;

    public function __construct(AuthorRepositoryInterface $authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }

    public function getAllAuthors(): Collection
    {
        return $this->authorRepo->all();
    }

    public function findAuthorByName(string $name): ?Author
    {
        return $this->authorRepo->findByName($name);
    }

    public function getAuthorById(int $id): ?Author
    {
        return $this->authorRepo->findById($id);
    }

    public function createAuthor(array $data): ?Author
    {
        return $this->authorRepo->create($data);
    }

    public function updateAuthor(int $id, array $data): ?Author
    {
        return $this->authorRepo->update($id, $data);
    }

    public function deleteAuthor(int $id): bool
    {
        return $this->authorRepo->delete($id);
    }
}
