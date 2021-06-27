<?php

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

class UpdateGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'steam:update-game {game?}';
    //protected $signature = 'steam:update-game {game=Forza}';
      protected $signature = 'steam:update-game {game}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update list of games';

    private Factory $httpClient;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Factory $httpClient)
    {
        $this->httpClient = $httpClient;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $responsePost = $this->httpClient->post('https://postman-echo.com/postsss', [
            'foo' => 'bar',
            'alfa' => 'omega',
            'elo' => 'ziom'

        ]);

        dump($responsePost->json());
        dump($responsePost->status());

        if ($responsePost->failed()) {
            $this->error('blad aplikacji');
        }

        return 0;
    }

//    public function handle_one()
//    {
//        $game = $this->argument('game');
//        $this->line($game);
//
////        $question = $this->ask("Czy to twoja ulubiona gra");
////
////        if($question) {
////
////        }
////        dump($question);
////        if ($this->confirm("Czy chcesz zaktualizować gre")) {
////            dump("Zrobiles to");
////        }
//
//        $this->error('Eroor');
//        $this->question('question /');
//        $this->comment('comment ...');
//        $this->info('info ...');
//        $this->line('line ...');
//
//        return 0;
//    }


    /**
     * $response->body() : string;
     * $response->json() : array|mixed;
     * $response->status() : int;
     * $response->ok() : bool;
     * $response->successful() : bool;
     * $response->serverError() : bool;
     * $response->clientError() : bool;
     * $response->header($header) : string;
     * $response->headers() : array;
     */

    //dump($response->body());
    //dump($response->json());

    //        $response = $this->httpClient->get('https://postman-echo.com/get', [
//            'foo' => 'bar',
//            'alfa' => 'omega'
//
//        ]);
}
