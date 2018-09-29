<?php 
namespace App\Processes\Setter;

use App\Processes\Setter\Traits\ProcessesSeeder;
use App\Processes\Setter\Traits\ChannelsMigrator;
use App\Processes\Setter\Traits\ChannelsAttacher;


/**
 * Interface IProcessesSetter
 * 
 * Define processes setter methods.
 */ 
interface IProcessesSetter 
{
    /**
     * Seed processes & channales
     * 
     * @return void
     */
    public function seed();


    /**
     * Migrate channales tables
     * 
     * @return void
     */
    public function migrate();    


    /**
     * Attach processes to channels 
     * 
     * @return void
     */
    public function attach();        
}
