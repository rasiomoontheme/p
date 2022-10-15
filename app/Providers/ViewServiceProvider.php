<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    protected $admin;

    protected $agent;

    public function __construct()
    {
        $this->admin = [
            'admin.*'
        ];

        $this->agent = [
            'agent.*'
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer($this->admin,function($view){
            $_title = Permission::getRouteTitle();
            $_user = auth()->guard('web')->user();
            $view->with(compact('_title','_user'));
        });

        view()->composer($this->agent,function($view){
            $_member = auth()->guard('agent')->user();
            $view->with(compact('_member'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
