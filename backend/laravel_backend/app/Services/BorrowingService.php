<?php

namespace App\Services;

use App\Contracts\BorrowingRepositoryInterface;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Collection;

class BorrowingService
{
    protected BorrowingRepositoryInterface $borrowingRepo;

    public function __construct(BorrowingRepositoryInterface $borrowingRepo)
    {
        $this->borrowingRepo = $borrowingRepo;
    }

    public function getAllBorrowings(): Collection
    {
        return $this->borrowingRepo->all(['*'], ['user', 'book', 'fine']);
    }

    public function getBorrowingById(int $id): ?Borrowing
    {
        return $this->borrowingRepo->findById($id, ['*'], ['user', 'book', 'fine']);
    }

    public function createBorrowing(array $data): ?Borrowing
    {
        return $this->borrowingRepo->create($data);
    }

    public function updateBorrowing(int $id, array $data): ?Borrowing
    {
        return $this->borrowingRepo->update($id, $data);
    }

    public function deleteBorrowing(int $id): bool
    {
        return $this->borrowingRepo->delete($id);
    }

    public function getBorrowingsByStatus(string $status)
    {
        return $this->borrowingRepo->findByStatus($status);
    }
    public function markAsReturned(int $id): bool
    {
        return $this->borrowingRepo->markAsReturned($id);
    }
    public function getAllUsers()
    {
        return $this->borrowingRepo->getAllUsers();
    }
    public function getAllBooks()
    {
        return $this->borrowingRepo->getAllBooks();
    }
}
