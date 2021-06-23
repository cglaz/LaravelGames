<?php

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

class LoadGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'steam:load-games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Steam - load games from Steam service';

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
        dump('kod do wykonania');
        return 0;
    }
}
