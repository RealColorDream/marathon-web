<?php

namespace App\Providers;

use App\Repositories\EtapeRepository;
use App\Repositories\IEtapeRepository;
use App\Repositories\IVoyageRepository;
use App\Repositories\VoyageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IVoyageRepository::class, VoyageRepository::class
        );
        $this->app->bind(
            IEtapeRepository::class, EtapeRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
