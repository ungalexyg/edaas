<?php

use Illuminate\Database\Seeder;

use ChanneslSeeder;
use ProcessesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ChanneslSeeder::class,
            ProcessesSeeder::class,
            ProcessesChannelsSeeder::class
        ]);
    }
}
