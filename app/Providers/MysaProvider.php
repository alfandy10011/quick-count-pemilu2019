<?php

namespace App\Providers;

use App\Helpers\FaceDetector;
use Illuminate\Support\ServiceProvider;

class MsyaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FaceDetector::class, function ($app) {
            return new FaceDetector(
                $app['router'],
                $app['url']
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [
        	FaceDetector::class
		];
    }
}
