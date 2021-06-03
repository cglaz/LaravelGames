<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        DB::table('games')->truncate();
        for ($j = 0; $j <10; $j++) {
            $games = [];
            for ($i = 0; $i < 10; $i++) {
             $games[] = [
                 'publisher_id' => $faker->numberBetween(1,100)
                 ];
            }
            DB::table('games')->insert($games);
        }

//        for ($j = 0; $j <10; $j++) {
//            $games = [];
//            for ($i = 0; $i < 1000; $i++) {
//                $games[] = [
//                    'title' => $faker->words($faker->numberBetween(1, 5), true),
//                    'description' => $faker->sentence,
//                    'publisher' => $faker->randomElement(['Atari', 'FA', 'CD-Action', 'Ubisoft', 'Twoj Stary']),
//                    'score' => $faker->numberBetween(1, 9),
//                    'gener_id' => $faker->numberBetween(1, 5),
//                    'created_at' => Carbon::now(),
//                    'updated_at' => Carbon::now()
//                ];
//            };
//            DB::table('games')->insert($games);
//        }


//        for ($i = 0; $i <100; $i++) {
//        DB::table('games')->insert([
//            'title' => $faker->words($faker->numberBetween(1,5), true),
//            'description' => $faker->sentence,
//            'publisher' => $faker->randomElement(['Atari', 'FA', 'CD-Action', 'Ubisoft', 'Twoj Stary']),
//            'score' => $faker->numberBetween(1,9),
//            'gener_id' => $faker->numberBetween(1,5),
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now()
//        ]);
//        }
    }
}
