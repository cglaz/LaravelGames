<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        DB::table('movies')->truncate();

        for ($i = 0; $i <100; $i++) {
            DB::table('movies')->insert([
                'name_of_movie' => $faker->words($faker->numberBetween(1, 5), true),
                'gener' => $faker->word(),
                'director' => $faker->word(),
                'release_date' => $faker->dateTime()
            ]);
        }
    }
}
