<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class SHAHashServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('hash', function () {
            return new SHAHasher();
        });
    }


    public function provides()
    {
        return array('hash');
    }
}
