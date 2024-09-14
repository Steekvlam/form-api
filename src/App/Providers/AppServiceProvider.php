<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $basePath = app_path('../');
        $loadExtraMigrations = [];

        $directories = glob($basePath . '**/**/**', GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            if (str_contains($directory, 'database/migrations')) {
                $loadExtraMigrations[] = $directory;
            } elseif (str_contains($directory, 'database')) {
                $loadExtraMigrations[] = $directory . DIRECTORY_SEPARATOR . 'migrations';
            }
        }

        $this->loadMigrationsFrom($loadExtraMigrations);
    }
}
