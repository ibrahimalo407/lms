<?php

namespace App\Providers;

use Socialite;
use SocialiteProviders\Zoom\Provider;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;


class ZoomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // No need to register anything here for now.
    }

    /**
     * Bootstrap services.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     * @return void
     */
    public function boot()
    {
        $this->app->make('Laravel\Socialite\Contracts\Factory')->extend('zoom', function ($app) {
            $config = $app['config']['services.zoom'];
            return \Socialite::buildProvider(SocialiteProviders\Zoom\Provider::class, $config);
        });
    }
}
