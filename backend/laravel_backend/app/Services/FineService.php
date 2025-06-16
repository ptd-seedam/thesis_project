<?php

namespace App\Services;

use App\Contracts\FineRepositoryInterface;
use App\Models\Fine;
use Illuminate\Database\Eloquent\Collection;

class FineService
{
    protected FineRepositoryInterface $fineRepo;

    public function __construct(FineRepositoryInterface $fineRepo)
    {
        $this->fineRepo = $fineRepo;
    }

    public function getAllFines(): Collection
    {
        return $this->fineRepo->all(['*'], ['user', 'borrowing']);
    }

    public function getFineById(int $id): ?Fine
    {
        return $this->fineRepo->findById($id, ['*'], ['user', 'borrowing']);
    }

    public function createFine(array $data): ?Fine
    {
        return $this->fineRepo->create($data);
    }

    public function updateFine(int $id, array $data): ?Fine
    {
        return $this->fineRepo->update($id, $data);
    }

    public function deleteFine(int $id): bool
    {
        return $this->fineRepo->delete($id);
    }

    public function getFinesByPaidStatus(bool $paidStatus)
    {
        return $this->fineRepo->findByPaidStatus($paidStatus);
    }
    public function getAllUsers()
    {
        return $this->fineRepo->getAllUsers();
    }
    public function getAllBorrowings()
    {
        return $this->fineRepo->getAllBorrowings();
    }
}
