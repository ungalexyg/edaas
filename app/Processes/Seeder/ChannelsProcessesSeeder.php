<?php 

namespace App\Processes\Seeder;

use App\Models\Channel\Channel;
use App\Models\Process\Process;
use Illuminate\Support\Carbon;
use App\Enums\DBColumnsEnum as Column;
use App\Exceptions\Processors\ProcessesSetterException as Exception;


/**
 * Channels processes seeder
 */ 
class ChannelsProcessesSeeder implements IProcessesSeeder
{

//    /**
//      * Process age temp handler
//      * the dates will be updates after the 1st process, this is just to allow the processor to start 
//      * 
//      * @var int
//      */
//     protected $process_age_days = 1;


    /**
     * Processes config holder, config('processes')
     * 
     * @var int
     */
    protected $config = [];



    /**
     * Handle channels processes seeding 
     * 
     * @return void
     */
    public function seed() 
    {

        $this->config = config('processes');

        $this->seedChannels();
        
        $this->seedChannelsProcesses();

        $this->cleanChannelsProcesses();
    }


    /**
     * Seed channels
     * 
     * @return void
     */
    protected function seedChannels() 
    {
        $seeds =  $this->config['channels'];

        foreach($seeds as $key => $seed) 
        {
            Channel::updateOrCreate(['key' => $key], $seed);
        }       
    }  


    /**
     * Seed processes
     * 
     * @return void
     */
    protected function seedChannelsProcesses() 
    {
        $processes = $this->config['channels_processes'];

        $channels = Channel::all();

        foreach($channels as $channel) 
        {
            $channel_processes = $processes[$channel->key] ?? [];

            foreach($channel_processes as $process_key => $process_seed) 
            {
                // prepare full seed 
                $process_seed['key'] = $process_key;

                // check if the process exist from previews seeds
                $process = Process::where([
                    ['processable_id', '=', $channel->id],
                    ['processable_type', '=', get_class($channel)],
                    ['key', '=', $process_key],
                ])->first();
                  
                // if exist, update it
                if($process) 
                {
                    $process->update($process_seed);   
                    $action = 'updated';
                }
                else 
                {
                    // prepare new instance
                    $process = new Process($process_seed);
                    $action = 'created';
                }

                // save the process for the channel
                $channel->processes()->save($process);

                echo 'process '. $process->id . ' '. $process->key . ' | ' . $action . "\n";
            }
        }       
    }


    /**
     * Delete old channels processes
     */
    protected function cleanChannelsProcesses() 
    {
        $channels_processes = $this->config['channels_processes'];
        
        $processes = Process::all();

        foreach($processes as $process) 
        {   
            $process_configed = false;

            foreach($channels_processes as $channel_processes) 
            {
                foreach($channel_processes as $process_key => $process_seed) 
                {
                    if($process->key == $process_key) 
                    {
                        $process_configed = true;
                    }
                }
            }   

            if(!$process_configed) 
            {
                $process->delete();
                echo 'process '. $process->id . ' '. $process->key . ' | deleted' . "\n";
            }
        }     
    }   
}
