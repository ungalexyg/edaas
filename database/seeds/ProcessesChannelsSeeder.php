<?php

use Illuminate\Database\Seeder;

use App\Processes\Base\ProcessorSetter;


class ProcessesChannelsSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         (new ProcessorSetter)->processesChannels();   
    }
}


