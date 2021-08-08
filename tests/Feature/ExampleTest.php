<?php

namespace Tests\Feature;

use App\Model\Game;
use App\Model\Publisher;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function testExample()
    {
//        $game = factory(Game::class)->make();
//        $games = factory(Game::class, 10)->make();
//
//        $game = factory(Game::class)->make([
//            'id' => 777,
//            'name' => 'Unereal'
//        ]);

        //factory(Game::class)->create();
        factory(Game::class)->create();

        $game = factory(Game::class)
            ->create(['id' => 11])
            ->each(function ($model) {
                $model->publishers()
                    ->saveMany(
                        factory(Publisher::class, 2)->make()
                    );
            });

        $games = Game::find(11);

//        print_r($games->publishers);
//        exit;

//        print_r($game);
//        exit;

        $this->assertTrue(true);
    }
}
