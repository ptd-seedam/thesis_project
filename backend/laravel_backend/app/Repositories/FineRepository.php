<?php

namespace App\Repositories;

use App\Contracts\FineRepositoryInterface;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\User;

class FineRepository extends BaseRepository implements FineRepositoryInterface
{
    public function __construct(Fine $model)
    {
        parent::__construct($model);
    }

    public function findByPaidStatus(bool $paidStatus)
    {
        return $this->model->where('F_PAID_STATUS', $paidStatus)->get();
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getAllBorrowings()
    {
        return Borrowing::all();
    }
}
