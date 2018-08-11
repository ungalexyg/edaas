<?php

use Illuminate\Database\Seeder;
use App\Processes\Base\ProcessorSetter;


class ChannelsProcessesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new ProcessorSetter)->channelsProcesses(); 
    }
}


