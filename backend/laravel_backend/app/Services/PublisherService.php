<?php

namespace App\Services;

use App\Contracts\PublisherRepositoryInterface;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Collection;

class PublisherService
{
    protected PublisherRepositoryInterface $publisherRepo;

    public function __construct(PublisherRepositoryInterface $publisherRepo)
    {
        $this->publisherRepo = $publisherRepo;
    }

    public function getAllPublishers(): Collection
    {
        return $this->publisherRepo->all();
    }

    public function findPublisherByName(string $name): ?Publisher
    {
        return $this->publisherRepo->findByName($name);
    }

    public function getPublisherById(int $id): ?Publisher
    {
        return $this->publisherRepo->findById($id);
    }

    public function createPublisher(array $data): ?Publisher
    {
        return $this->publisherRepo->create($data);
    }

    public function updatePublisher(int $id, array $data): ?Publisher
    {
        return $this->publisherRepo->update($id, $data);
    }

    public function deletePublisher(int $id): bool
    {
        return $this->publisherRepo->delete($id);
    }
}
