<?php

namespace App\Providers;

use App\Service\FakeService;
use Illuminate\Support\ServiceProvider;

class FakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //dump('Fake - register');
        $this->app->bind(
            FakeService::class,
            function($pp) {
                dump('Fake - register - bind');
                return new FakeService('parametr');
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //dump('Fake - boot');
    }
}
