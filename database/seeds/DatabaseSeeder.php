<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @note: seeds that related to processes e.g: processes, channels, processes_channels
     * should be run via the command: php artisan process:set which will seed records and perform relations attachments based on processes config
     * 
     * @return void
     */
    public function run()
    {
        $this->call([
            // CustomSeeder::class,
            // ...
        ]);
    }
}
