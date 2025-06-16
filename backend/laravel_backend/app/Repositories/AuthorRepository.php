<?php

namespace App\Repositories;

use App\Contracts\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }

    public function findByName(string $name): ?Author
    {
        return $this->model->where('A_NAME', $name)->first();
    }
}
