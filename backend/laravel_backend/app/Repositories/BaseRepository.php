<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    public function create(array $payload): ?Model
    {
        return $this->model->create($payload);
    }

    public function update(int $id, array $payload): ?Model
    {
        $model = $this->findById($id);
        if (!$model) return null;

        $model->update($payload);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->findById($id);
        if (!$model) return false;

        return $model->delete();
    }

    public function paginate(int $perPage = 15, array $columns = ['*'], array $relations = []): LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*'], array $relations = []): ?Model
    {
        $query = $this->model->with($relations);
        foreach ($criteria as $field => $value) {
            $query->where($field, $value);
        }
        return $query->first($columns);
    }

    public function findByOrFail(array $criteria, array $columns = ['*'], array $relations = []): Model
    {
        $query = $this->model->with($relations);
        foreach ($criteria as $field => $value) {
            $query->where($field, $value);
        }
        return $query->firstOrFail($columns);
    }

    public function count(array $criteria = []): int
    {
        $query = $this->model;
        foreach ($criteria as $field => $value) {
            $query->where($field, $value);
        }
        return $query->count();
    }
}
