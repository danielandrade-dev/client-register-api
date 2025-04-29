<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Client;

class ClientService
{
    public function __construct(
        protected ClientRepositoryInterface $repository
    ) {
    }

    public function getAllClients(): Collection
    {
        return $this->repository->getAll();
    }

    public function getClientById(int $id): ?Client
    {
        return $this->repository->findById($id);
    }

    public function createClient(array $data): Client
    {
        return $this->repository->create($data);
    }

    public function updateClient(int $id, array $data): ?Client
    {
        return $this->repository->update($id, $data);
    }

    public function deleteClient(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
