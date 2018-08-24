<?php

use Illuminate\Database\Seeder;
use App\Processes\Processors\Base\ProcessesSetter;



class ChannelsProcessesSeeder extends Seeder
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


