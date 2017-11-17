<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['validator']->extend('EmailUnique', function ($attribute, $value, $parameters)
        {
           $validator = new \App\Rules\EmailUnique();
           return $validator->passes($attribute, $value);
        });
    }

    public function register()
    {
        //
    }
}
