<?php

namespace ScumPetard\IpCheck;

use Illuminate\Support\ServiceProvider;

class IpCheckProvider extends ServiceProvider
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
        $this->app->singleton('IpCheck', function () {
            return new IpCheck();
        });
    }
}
