<?php

namespace App\Repositories;

use App\Contracts\BorrowingRepositoryInterface;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;

class BorrowingRepository extends BaseRepository implements BorrowingRepositoryInterface
{
    public function __construct(Borrowing $model)
    {
        parent::__construct($model);
    }

    public function findByStatus(string $status)
    {
        return $this->model->where('BR_STATUS', $status)->get();
    }
    public function markAsReturned($id)
    {
        $borrowing = $this->model->find($id);
        if ($borrowing) {
            $borrowing->BR_STATUS = 'returned';
            return $borrowing->save();
        }
        return false;
    }
    public function getAllUsers()
    {
        return User::where('U_ROLE', '!=', 'admin')->get();
    }
    public function getAllBooks()
    {
        return Book::all();
    }
    public function getBorrowingById(int $id, array $columns = ['*'], array $relations = []): ?Borrowing
    {
        return $this->model->with($relations)->find($id, $columns);
    }
    public function findByUserId(int $userId, array $columns = ['*'], array $relations = []): ?Borrowing
    {
        return $this->model->with($relations)->where('U_ID', $userId)->first($columns);
    }
    public function findByBookId(int $bookId, array $columns = ['*'], array $relations = []): ?Borrowing
    {
        return $this->model->with($relations)->where('B_ID', $bookId)->first($columns);
    }
}
