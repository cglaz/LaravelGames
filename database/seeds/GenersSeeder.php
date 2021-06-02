<?php

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
        DB::table('geners')->truncate();
        DB::table('geners')->insert([
            ['name' => 'FPS111', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'FPS222', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'FPS333', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'FPS444', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}
