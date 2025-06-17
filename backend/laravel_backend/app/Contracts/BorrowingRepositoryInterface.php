<?php

namespace App\Contracts;

use App\Models\Borrowing;

interface BorrowingRepositoryInterface extends BaseRepositoryInterface
{
    // Ví dụ phương thức tìm lượt mượn theo trạng thái
    public function findByStatus(string $status);
    public function markAsReturned($id);
    public function getAllUsers();
    public function getAllBooks();
    public function getBorrowingById(int $id, array $columns = ['*'], array $relations = []): ?Borrowing;
    public function findByUserId(int $userId, array $columns = ['*'], array $relations = []): ?Borrowing;
    public function findByBookId(int $bookId, array $columns = ['*'], array $relations = []): ?Borrowing;
}
