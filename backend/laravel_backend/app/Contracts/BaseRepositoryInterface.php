<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []): Collection;
    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Model;
    public function create(array $payload): ?Model;
    public function update(int $id, array $payload): ?Model;
    public function delete(int $id): bool;
    public function paginate(int $perPage = 15, array $columns = ['*'], array $relations = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function findBy(array $criteria, array $columns = ['*'], array $relations = []): ?Model;
    public function findByOrFail(array $criteria, array $columns = ['*'], array $relations = []): Model;
    public function count(array $criteria = []): int;
}
