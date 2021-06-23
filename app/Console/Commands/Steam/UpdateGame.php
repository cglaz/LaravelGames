<?php

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $game = $this->argument('game');
        $this->line($game);

//        $question = $this->ask("Czy to twoja ulubiona gra");
//
//        if($question) {
//
//        }
//        dump($question);
//        if ($this->confirm("Czy chcesz zaktualizować gre")) {
//            dump("Zrobiles to");
//        }

        $this->error('Eroor');
        $this->question('question /');
        $this->comment('comment ...');
        $this->info('info ...');
        $this->line('line ...');

        return 0;
    }
}
