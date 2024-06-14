<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\FileRepositoryInterface;
use App\Repositories\FileRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register los repositorios en el contenedor de servicios.
     * - Vincular la interfas y la implementación
     */
    public function register(): void
    {
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
