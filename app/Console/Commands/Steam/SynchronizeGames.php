<?php

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SynchronizeGames extends Command
{

    protected $signature = 'steam:synchronize-games {steep=1}';

    protected $description = 'Synchronize steam games';

    private Factory $httpClient;

    private string $temporaryGamesListSync = './storage/app/steamSync';

    private array $genres = [];
    private array $publishers = [];
    private array $developers = [];

    public function __construct(Factory $httpClient)
    {
        parent::__construct();
        $this->httpClient = $httpClient;
    }


    public function synchronizeGameListWithSteamGameList()
    {
        $steamAllGamesUrl = config('steam.api.games.all');
        $response = $this->httpClient->get($steamAllGamesUrl);


        if ($response->failed()) {
            $this->error('Request failed. Status code: ' . $response->status());
            exit;
        }

        $responseContent = $response->json();

        $apps = $responseContent['applist']['apps'];

        $jsonApps = json_encode($apps);

        $res = file_put_contents($this->temporaryGamesListSync, $jsonApps);

        $this->info('Update list of games');
    }

    public function handle()
    {
        $steep = $this->argument('steep');
        if ($steep == 1) {
            $this->synchronizeGameListWithSteamGameList();
            return 0;
        }

        $gameList = file_get_contents($this->temporaryGamesListSync);
        $gameList = json_decode($gameList, true);

        $savedGames = DB::table('games')
            ->select('steam_appid')
            ->pluck('steam_appid')
            ->toArray();
        $savedGames = array_flip($savedGames);

        $progressDb = $this->output->createProgressBar(count($gameList));

        foreach ($gameList as $row) {
            // {"appid":216938,"name":"Pieterw"}
            $appId = $row['appid'];

            foreach ($savedGames as $key=>$value) {
                if (array_key_exists($key, array_flip($row))) {
                    $progressDb->advance();
                    $this->info(' this game exists in ' . $appId);

                } else if (!array_key_exists($key, array_flip($row)))
                    $this->info(' this game must added ' . $appId);
                else {
                    $this->info('This game deleted'.$appId);
                }
            }

        }

        $progressDb->finish();

        $this->info('End from DB');

        return 0;
    }

    private function create($data)
    {
        $result = DB::transaction(function () use ($data) {

            $data = array_shift($data);
            if ($data['success'] !== true) {
                return;
            }

            $data = $data['data'];
            $game = [
                'steam_appid' => $data['steam_appid'],
                'relation_id' => !empty($data['fullgame']) ? (int) $data['fullgame']['appid'] : null,
                'name' => $data['name'],
                'type' => $data['type'],

                'description' => $data['detailed_description'],
                'short_description' => $data['short_description'],
                'about' => $data['about_the_game'],
                'image' => $data['header_image'],
                'website' => $data['website'],

                'price_amount' => $data['price_overview']['initial'] ?? null,
                'price_currency' => $data['price_overview']['currency'] ?? null,

                'metacritic_score' => $data['metacritic']['score'] ?? null,
                'metacritic_url' => $data['metacritic']['url'] ?? null,
                'release_date' => $data['release_date']['date'],
                'languages' => $data['supported_languages'] ?? null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $gameId = DB::table('games')->insertGetId($game);

            foreach ($data['genres'] ?? [] as $genre) {
                if (empty($this->genres[$genre['id']])) {
                    $genreData = [
                        'id' => $genre['id'],
                        'name' => $genre['description'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $result = DB::table('genres')->insert($genreData);
                    $this->genres[$genreData['id']] = $genreData;
                }

                DB::table('gameGenres')->insert([
                    'game_id' => $gameId,
                    'genre_id' => $genre['id']
                ]);
            }

            foreach ($data['publishers'] ?? [] as $publisher) {
                if (empty($this->publishers[$publisher])) {
                    $publisherData = [
                        'name' => $publisher,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $publisherId = DB::table('publishers')->insertGetId($publisherData);
                    $publisherData['id'] = $publisherId;
                    $this->publishers[$publisher] = $publisherData;
                }

                $publisherId = $this->publishers[$publisher]['id'];

                DB::table('gamePublishers')->insert([
                    'game_id' => $gameId,
                    'publisher_id' => $publisherId
                ]);
            }

            foreach ($data['developers'] ?? [] as $developer) {
                if (empty($this->developers[$developer])) {
                    $developerData = [
                        'name' => $developer,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $developerId = DB::table('developers')->insertGetId($developerData);
                    $developerData['id'] = $developerId;
                    $this->developers[$developer] = $developerData;
                }

                $developerId = $this->developers[$developer]['id'];

                DB::table('gameDevelopers')->insert([
                    'game_id' => $gameId,
                    'developer_id' => $developerId
                ]);
            }

            foreach ($data['screenshots'] ?? [] as $screenshot) {
                DB::table('screenshots')->insert([
                    'game_id' => $gameId,
                    'thumbnail' => $screenshot['path_thumbnail'],
                    'url' => $screenshot['path_full'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            foreach ($data['movies'] ?? [] as $movie) {
                DB::table('movies')->insertOrIgnore([
                    'game_id' => $gameId,
                    'original_id' => $movie['id'],
                    'name' => $movie['name'],
                    'highlight' => $movie['highlight'],
                    'thumbnail' => $movie['thumbnail'],
                    'webm_480' => $movie['webm']['480'],
                    'webm_url' => $movie['webm']['max'],
                    'mp4_480' => $movie['mp4']['480'],
                    'mp4_url' => $movie['mp4']['max'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        });
    }

    private function delete($gameId)
    {

        return DB::table('games')->where('steam_appid', $gameId)
            ->delete();
    }
}
