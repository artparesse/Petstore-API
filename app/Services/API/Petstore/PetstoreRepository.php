<?php

namespace App\Services\API\Petstore;

use App\Exceptions\PetstoreException;
use App\Services\API\BaseApi;

class PetstoreRepository extends BaseApi implements PetstoreInterface
{
    protected string $baseUrl = 'https://petstore.swagger.io/v2/pet';

    protected $exceptionClass = PetstoreException::class;

    public function findByStatus( PetStatus $status ) {
        return $this->get( "/findByStatus?status={$status->value}" );
    }

    public function findById( int $id ) {
        return $this->get( "/{$id}" );
    }

    public function create( array $data ) {
        return $this->post( "/", [
            'body'    => json_encode( $data ),
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ] );
    }

    public function updateById( int $id, array $data ) {
        return $this->post( "/{$id}", [ 'form-params' => $data ] );
    }

    public function update( array $data ) {
        return $this->put( "/", [
            'body'    => json_encode( $data ),
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ] );
    }

    public function deleteById( int $id ): array {
        return $this->delete( "/{$id}" );
    }
}
