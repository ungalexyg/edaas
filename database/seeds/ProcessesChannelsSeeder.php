<?php

use Illuminate\Database\Seeder;
use App\Processes\Setter\ProcessesSetter;

/**
 * Processes Channels Seeder
 */
class ProcessesChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new ProcessesSetter)->setProcessesChannels(); 
    }
}


