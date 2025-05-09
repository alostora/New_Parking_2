<?php

namespace Client\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        foreach (glob(base_path('/packages/Client/routes/*.php')) as $file) {
            Route::prefix('client')
                ->middleware(['web', 'lang'])
                ->group($file);
        }

        $this->bindRoutes($router);
    }

    protected function bindRoutes(Router $router) {}
}
