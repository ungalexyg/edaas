<?php 

namespace App\Processes\Seeder;


/**
 * Processor Seeder, handle processes seeding
 */ 
class ProcessesSeeder implements IProcessesSeeder
{
    /**
     * Seed processes
     * 
     * @return void 
     */
    public function seed() 
    {   
        (new ChannelsProcessesSeeder)->seed();
        
        // (new SampleProcessesSeeder)->seed(); ...
    }
}
