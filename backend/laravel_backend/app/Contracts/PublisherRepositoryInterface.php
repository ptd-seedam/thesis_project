<?php

namespace App\Contracts;

use App\Models\Publisher;

interface PublisherRepositoryInterface extends BaseRepositoryInterface
{
    public function findByName(string $name): ?Publisher;
}
