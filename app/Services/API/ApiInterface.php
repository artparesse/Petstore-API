<?php

namespace App\Services\API;

interface ApiInterface
{
    public function get( string $endpoint ): array;
    public function post( string $endpoint, array $data = [] ): array;
    public function put( string $endpoint, array $data = [] ): array;
    public function delete( string $endpoint ): array;
}
