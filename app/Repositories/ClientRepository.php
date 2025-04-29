<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    public function __construct(protected Client $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): ?Client
    {
        return $this->model->find($id);
    }

    public function create(array $data): Client
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): ?Client
    {
        $client = $this->findById($id);
        if (!$client) {
            return null;
        }

        $client->update($data);
        return $client;
    }

    public function delete(int $id): bool
    {
        $client = $this->findById($id);
        if (!$client) {
            return false;
        }

        return $client->delete();
    }
}
