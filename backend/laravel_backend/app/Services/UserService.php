<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepo->all();
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepo->findById($id);
    }

    public function createUser(array $data): User
    {
        return $this->userRepo->create($data);
    }

    public function updateUser(int $id, array $data): ?User
    {
        return $this->userRepo->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepo->delete($id);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepo->findByEmail($email);
    }

    public function getUsersByRole(int $role)
    {
        return $this->userRepo->findByRole($role);
    }
}
