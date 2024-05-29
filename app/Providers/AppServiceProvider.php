<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Zoom\ZoomExtendSocialite;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->singleton(
            \Laravel\Socialite\Contracts\Factory::class,
            \Laravel\Socialite\SocialiteManager::class
        );

        $this->app['events']->listen(
            SocialiteWasCalled::class,
            ZoomExtendSocialite::class
        );
    }
}
