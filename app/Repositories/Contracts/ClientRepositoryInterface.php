<?php

namespace App\Repositories\Contracts;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

interface ClientRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Client;
    public function create(array $data): Client;
    public function update(int $id, array $data): ?Client;
    public function delete(int $id): bool;
}
