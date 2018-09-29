<?php 

namespace App\Processes\Setter\Traits;

use App\Models\Channel\Channel;
use App\Models\Process\Process;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Database\Migrations\Migration;


/**
 * Processes Seeder
 * 
 * Handle channels & processes seeding based on processes config
 */ 
trait ProcessesSeeder  
{
    /**
     * Seed processes & channels
     */
    public function seed() 
    {   
        $this->seedProcesses(); 
        
        $this->seedChannels();
    }


    /**
     * Seed processes
     * 
     * @return void
     */
    public function seedProcesses() 
    {
        $seeds = config('processes.processes');

        foreach($seeds as  $key => $seed) 
        {
            Process::updateOrCreate(['key' => $key], $seed);
        }       
    }


    /**
     * Seed channels
     * 
     * @return void
     */
    public function seedChannels() 
    {
        $seeds = config('processes.channels');

        foreach($seeds as $key => $seed) 
        {
            Channel::updateOrCreate(['key' => $key], $seed);
        }       
    }    
}
