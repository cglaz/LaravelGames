<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GenersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *geners
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        DB::table('geners')->truncate();
        for ($j = 0; $j <10; $j++) {
        $geners = [];
            for ($i = 0; $i<10; $i++) {
                $geners[] = [
                    'name' => $faker->words($faker->numberBetween(1, 5), true),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        DB::table('geners')->insert($geners);
        }
    }
}
