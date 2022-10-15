<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\\Http\\Controllers';

    public const HOME = '/home';

    public function boot()
    {
        //

        parent::boot();
    }

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapBackendRoutes();
        $this->mapAgentRoutes();
        $this->mapFrontendRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapBackendRoutes()
    {
        Route::prefix(getConfig('route_alias.backend'))
            ->middleware('web')
            ->namespace($this->namespace . '\Backend\Admin')
            ->group(base_path('routes/backend.php'));
    }

    protected function mapAgentRoutes()
    {
        Route::prefix(getConfig('route_alias.agent'))
            ->middleware('web')
            ->namespace($this->namespace . '\Backend\Agent')
            ->group(base_path('routes/agent.php'));
    }

    protected function mapFrontendRoutes()
    {
        Route::prefix(getConfig('route_alias.frontend'))
            ->middleware('frontend')
            ->namespace($this->namespace . '\Frontend')
            ->group(base_path('routes/frontend.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix(getConfig('route_alias.api'))
            ->middleware('api')
            ->namespace($this->namespace . '\Api')
            ->group(base_path('routes/api.php'));
    }
}
