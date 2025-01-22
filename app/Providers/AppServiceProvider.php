<?php

namespace App\Providers;

use App\Services\API\Petstore\PetstoreInterface;
use App\Services\API\Petstore\PetstoreRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PetstoreInterface::class, PetstoreRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
