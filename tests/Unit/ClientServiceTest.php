<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Services\ClientService;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class ClientServiceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_get_all_clients()
    {
        $mockRepo = Mockery::mock(ClientRepositoryInterface::class);
        $mockRepo->shouldReceive('getAll')->once()->andReturn(new Collection());
        $service = new ClientService($mockRepo);
        $this->assertInstanceOf(Collection::class, $service->getAllClients());
    }

    public function test_get_client_by_id()
    {
        $client = new Client(['name' => 'Teste', 'email' => 'a@a.com', 'phone' => '1', 'address' => 'Rua']);
        $mockRepo = Mockery::mock(ClientRepositoryInterface::class);
        $mockRepo->shouldReceive('findById')->with(1)->once()->andReturn($client);
        $service = new ClientService($mockRepo);
        $this->assertEquals($client, $service->getClientById(1));
    }

    public function test_create_client()
    {
        $data = ['name' => 'Teste', 'email' => 'a@a.com', 'phone' => '1', 'address' => 'Rua'];
        $client = new Client($data);
        $mockRepo = Mockery::mock(ClientRepositoryInterface::class);
        $mockRepo->shouldReceive('create')->with($data)->once()->andReturn($client);
        $service = new ClientService($mockRepo);
        $this->assertEquals($client, $service->createClient($data));
    }

    public function test_update_client()
    {
        $data = ['name' => 'Novo'];
        $client = new Client(['name' => 'Novo']);
        $mockRepo = Mockery::mock(ClientRepositoryInterface::class);
        $mockRepo->shouldReceive('update')->with(1, $data)->once()->andReturn($client);
        $service = new ClientService($mockRepo);
        $this->assertEquals($client, $service->updateClient(1, $data));
    }

    public function test_delete_client()
    {
        $mockRepo = Mockery::mock(ClientRepositoryInterface::class);
        $mockRepo->shouldReceive('delete')->with(1)->once()->andReturn(true);
        $service = new ClientService($mockRepo);
        $this->assertTrue($service->deleteClient(1));
    }
}
