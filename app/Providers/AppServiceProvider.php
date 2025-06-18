<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    
    public function boot(): void
    {
        $this->app['router']->middlewareGroup('auth', [
            Authenticate::class,
        ]);

        $this->app['router']->middlewareGroup('role', [
            CheckRole::class,
        ]);

        $this->app['router']->aliasMiddleware('role', CheckRole::class);

        Paginator::useBootstrapFive(); 
    }
}
