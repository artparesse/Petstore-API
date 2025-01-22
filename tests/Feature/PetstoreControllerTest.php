<?php

namespace Tests\Feature;

use App\Http\Controllers\PetController;
use App\Http\Requests\Petstore\StorePetRequest;
use App\Services\PetstoreService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class PetstoreControllerTest extends TestCase
{
    protected PetController $controller;
    protected MockInterface $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = Mockery::mock(PetstoreService::class);
        $this->controller = new PetController($this->service);
    }

    public function testIndex(): void
    {
        $status = 'available';
        $pets = [
            ['id' => 1, 'name' => 'Doggo', 'status' => $status],
            ['id' => 2, 'name' => 'Kitty', 'status' => $status]
        ];

        $this->service->expects('getAllByStatus')->with($status)->andReturn([
            'pets' => $pets,
            'status' => $status
        ]);

        $request = Mockery::mock(Request::class);
        $request->expects('get')->with('status')->andReturn($status);

        $response = $this->controller->index($request);

        $this->assertSame('pets.index', $response->name());
        $this->assertArrayHasKey('pets', $response->getData());
        $this->assertArrayHasKey('currentStatus', $response->getData());
    }

    public function testStore(): void
    {
        $data = ['name' => 'Doggo', 'status' => 'available'];
        $createdPet = ['id' => 1, 'name' => 'Doggo', 'status' => 'available'];

        $this->service->expects('createPet')->with($data)->andReturn($createdPet);

        $request = Mockery::mock(StorePetRequest::class);
        $request->expects('validated')->andReturn($data);

        $response = $this->controller->store($request);

        $this->assertEquals(route('pets.show', ['id' => $createdPet['id']]), $response->headers->get('Location'));
    }
}
