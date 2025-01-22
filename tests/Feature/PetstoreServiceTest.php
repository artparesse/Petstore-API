<?php

namespace Tests\Feature;

use App\Services\API\Petstore\PetstoreRepository;
use App\Services\PetstoreService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class PetstoreServiceTest extends TestCase
{
    protected PetstoreService $service;
    protected MockInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(PetstoreRepository::class);
        $this->service = new PetstoreService($this->repository);
    }

    public function testCreatePet(): void
    {
        $data = ['name' => 'Doggo', 'status' => 'available'];
        $createdPet = ['id' => 1, 'name' => 'Doggo', 'status' => 'available'];

        $this->repository->expects('create')->with($data)->andReturn($createdPet);

        $result = $this->service->createPet($data);

        $this->assertSame($createdPet, $result);
    }

    public function testShowPet(): void
    {
        $id = 1;
        $pet = ['id' => 1, 'name' => 'Doggo', 'status' => 'available'];

        $this->repository->expects('findById')->with($id)->andReturn($pet);

        $result = $this->service->showPet($id);

        $this->assertSame($pet, $result);
    }
}
