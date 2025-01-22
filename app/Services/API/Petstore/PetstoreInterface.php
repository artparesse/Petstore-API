<?php

namespace App\Services\API\Petstore;

interface PetstoreInterface
{
    public function findByStatus( PetStatus $status );
    public function findById( int $id );
    public function create( array $data );
    public function updateById( int $id, array $data );
    public function update( array $data );
    public function deleteById( int $id );
}
