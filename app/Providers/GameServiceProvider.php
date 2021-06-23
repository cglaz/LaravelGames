<?php

namespace App\Providers;

use App\Http\Controllers\Game\BuilderController;
use App\Model\Game;
use App\Repository\GameRepository;
use App\Service\FakeService;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

//        $this->app->bind(
//            GameRepository::class, \App\Repository\Eloquent\GameRepository::class
//        );

//        $this->app->singleton(
//            GameRepository::class,
//            function ($app) {
//                dump('Game - register - bind');
//                $gameModel = $app->make(Game::class);
//
//                return new \App\Repository\Eloquent\GameRepository($gameModel);
//            }
//        );

        $this->app->singleton(GameRepository::class, \App\Repository\Eloquent\GameRepository::class);
//
//        $this->app->when(BuilderController::class)
//            ->needs(GameRepository::class)
//            ->give(fn($app) => new \App\Repository\Builder\GameRepository($app->make(Game::class)));

        $this->app->when(BuilderController::class)
            ->needs(GameRepository::class)
            ->give(\App\Repository\Builder\GameRepository::class);


        $this->app->singleton('game', GameRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
