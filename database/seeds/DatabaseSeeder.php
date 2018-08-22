<?php


use Illuminate\Database\Seeder;
// use ChannelsSeeder;
// use ProcessesSeeder;
// use ProcessesChannelsSeeder;


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
            ChannelsSeeder::class,
            ProcessesSeeder::class,
            ChannelsProcessesSeeder::class
        ]);
    }
}
