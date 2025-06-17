<?php

namespace App\Repositories;

use App\Contracts\PublisherRepositoryInterface;
use App\Models\Publisher;

class PublisherRepository extends BaseRepository implements PublisherRepositoryInterface
{
    public function __construct(Publisher $model)
    {
        parent::__construct($model);
    }
    public function findByName(string $name): ?Publisher
    {
        return $this->model->where('P_NAME', $name)->first();
    }
}
