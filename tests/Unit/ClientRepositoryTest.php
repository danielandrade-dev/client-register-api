<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_and_find_client()
    {
        $repo = new ClientRepository(new Client());
        $data = [
            'name' => 'Maria',
            'email' => 'maria@email.com',
            'phone' => '11988888888',
            'address' => 'Rua Teste, 456',
        ];
        $client = $repo->create($data);
        $this->assertDatabaseHas('clients', ['email' => 'maria@email.com']);
        $found = $repo->findById($client->id);
        $this->assertEquals('Maria', $found->name);
    }

    public function test_update_client()
    {
        $repo = new ClientRepository(new Client());
        $client = Client::factory()->create();
        $repo->update($client->id, ['name' => 'Alterado']);
        $this->assertDatabaseHas('clients', ['id' => $client->id, 'name' => 'Alterado']);
    }

    public function test_delete_client()
    {
        $repo = new ClientRepository(new Client());
        $client = Client::factory()->create();
        $repo->delete($client->id);
        $this->assertSoftDeleted('clients', ['id' => $client->id]);
    }

    public function test_get_all_clients()
    {
        Client::factory()->count(2)->create();
        $repo = new ClientRepository(new Client());
        $all = $repo->getAll();
        $this->assertCount(2, $all);
    }
}
