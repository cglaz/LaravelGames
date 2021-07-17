<?php

namespace App\Console\Commands\FileStorage;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FileStorageApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:api-example {example}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $command = $this->argument('example');

        switch ($command) {
            case 'create':
                //przyklad zapisu pliku
                Storage::disk('public')->put('files/exmample.txt', ' new kontent pliku');
                Storage::put('file.txt', ' new kontent pliku na domyslnym dysku');
                //Storage::disk('local')->put('file.txt', 'kontent pliku');
                break;
            case 'read':
                //$content = Storage::disk('local')->get('file.txt');
                $content = Storage::get('file.txt');
                $this->info($content);
                break;
            case 'exist':
                $exists = Storage::exists('file.txt');
                $missing = Storage::missing('file.txt');
                $this->info("EXISTS: $exists");
                $this->info("Missing: ".((int) $missing));
                break;
            case 'download':
                $name = 'NameForDownload.txt';
                Storage::download('file.txt');
                Storage::download('file.txt', $name);
                break;
            case 'localization':
                $url = Storage::disk('public')->url('file.txt');
                $path = Storage::path('avatars\1.png');
                $this->info("URL: $url");
                $this->info("PATH: $path");
                break;
            case 'relocation':
                //Storage::copy("file.txt", 'new_file.txt');
                Storage::move('new_file.txt', 'moved_file.txt');
                break;
            case 'delete':
                Storage::delete('file.txt');
                //Storage::delete(['moved_file.txt', ...]);
                break;
            case 'dirOperation':
                $directory = 'testDir';
                //Storage::makeDirectory($directory);
                Storage::deleteDirectory($directory);
                break;
        }
        $this->info('ok');
        return 0;
    }
}
