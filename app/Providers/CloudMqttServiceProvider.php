<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CloudMqttServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\CloudMQTTServiceProvider', function ($app) {
          return new CloudMQTT();
        });
    }
}
