<?php

namespace App\Services;

use App\Http\Requests\Petstore\StorePetRequest;
use App\Services\API\Petstore\PetStatus;
use App\Services\API\Petstore\PetstoreInterface;

class PetstoreService
{
    public function __construct( private PetstoreInterface $repository ) {}

    public function getAllByStatus(?string $status): array {
        $status = PetStatus::tryFrom($status) ?? PetStatus::AVAILABLE;
        $pets = $this->repository->findByStatus( $status );

        return [
            'pets' => $pets,
            'status' => $status->value
        ];
    }

    public function createPet(array $data) {
        return $this->repository->create( $data );
    }

    public function showPet( int $id ) {
        return $this->repository->findById( $id );
    }

    public function editPet( int $id ) {
        return $this->repository->findById( $id );
    }

    public function updatePet( array $data ) {
        return $this->repository->update( $data );
    }

    public function deletePet( int $id ) {
        return $this->repository->deleteById( $id );
    }
}
