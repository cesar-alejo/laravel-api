<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\File;
use App\Policies\FilePolicy;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(File::class, FilePolicy::class);
    }

    public function boot(): void
    {
        //
    }
}
