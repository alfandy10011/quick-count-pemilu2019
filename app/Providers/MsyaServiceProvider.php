<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Msya;

class MsyaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('msya',function($app){
            return new Msya();
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
