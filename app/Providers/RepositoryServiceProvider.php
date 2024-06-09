<?php

namespace App\Providers;

use App\Interfaces\ClienteRepositoryInterface;
use App\Repositories\ClienteRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClienteRepositoryInterface::class,ClienteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
