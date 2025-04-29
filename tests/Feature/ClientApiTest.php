<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_clients()
    {
        Client::factory()->count(3)->create();
        $response = $this->getJson('/api/clients');
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_can_create_client()
    {
        $data = [
            'name' => 'João da Silva',
            'email' => 'joao@email.com',
            'phone' => '11999999999',
            'address' => 'Rua Exemplo, 123',
        ];
        $response = $this->postJson('/api/clients', $data);
        $response->assertCreated()->assertJsonFragment(['email' => 'joao@email.com']);
        $this->assertDatabaseHas('clients', ['email' => 'joao@email.com']);
    }

    public function test_can_show_client()
    {
        $client = Client::factory()->create();
        $response = $this->getJson('/api/clients/' . $client->id);
        $response->assertOk()->assertJsonFragment(['email' => $client->email]);
    }

    public function test_can_update_client()
    {
        $client = Client::factory()->create();
        $response = $this->putJson('/api/clients/' . $client->id, [
            'name' => 'Novo Nome'
        ]);
        $response->assertOk()->assertJsonFragment(['name' => 'Novo Nome']);
        $this->assertDatabaseHas('clients', ['id' => $client->id, 'name' => 'Novo Nome']);
    }

    public function test_can_delete_client()
    {
        $client = Client::factory()->create();
        $response = $this->deleteJson('/api/clients/' . $client->id);
        $response->assertNoContent();
        $this->assertSoftDeleted('clients', ['id' => $client->id]);
    }
}
