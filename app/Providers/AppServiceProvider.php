<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(app()->isProduction());

        // Argumentos personalizados al compilar JS
        //Vite::useScriptTagAttributes([
        //    'async' => true,
        //]);

        // Argumentos personalizados al compilar CSS
        //Vite::useStyleTagAttributes([
        //    'async' => true,
        //]);
    }
}
