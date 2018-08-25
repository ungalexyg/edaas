<?php 

namespace App\Processes\Processors\Base;

use App\Models\Channel;
use App\Models\Process;
use Illuminate\Support\Carbon;
use App\Exceptions\Processors\ProcessorSetterException;


/**
 * Processor Setter
 * 
 * Handle Processor logistics.
 */ 
class ProcessesSetter  
{
    /**
     * process age temp handler
     * the dates will be updates after the 1st process, this is just to allow the processor to start 
     * 
     * @var int
     */
    protected $process_age_days = 1;


	/**
	 * Set processes channels 
	 * 
	 * @throws ProcessorSetterException
	 * @return void
	 */
	public function setProcessesChannels() 
	{
        $seeds = config('processes.processes_channels');

        $this->process_age_days = 1;

        // handle processes channels config
        foreach($seeds as $process_key => $process_channels) 
        {
            $process = Process::where('key', $process_key)->get()->first();
            
            if(!$process) throw new ProcessorSetterException('Trying to attach undefined procssee to channels. Run the ProcessesSeeder, then try again. | $process_key:' . $process_key); 
    
            var_dump('# setting process. | id: ' . $process->id . ' | key: ' . $process->key .  ' ...');

            # - detach previews process's channels     
            $this->detachProcessChannels($process, $process_channels); 
            
            # + attach new channel's processes
            $this->attachProcessChannels($process, $process_channels); 
        }   
    }


    /**
     * Detach process's channels that not defined in the config
     * 
	 * @param Process
     * @param array $process_channels // config('processes.processes_channels')
	 * @return void
     */
    protected function detachProcessChannels($process, $process_channels) 
    {
        // if the process has attached channels
        foreach($process->channels as $existing_channel) 
        {
            // check if process's existing channel is still relevant acording to the fresh config
            if(!in_array($existing_channel->key, $process_channels))  
            {                    
                var_dump('- detaching channel | id: ' . $existing_channel->id . ' | key: ' . $existing_channel->key);
                
                $process->channels()->detach($existing_channel->id); 

            } // else { //nothing, the process already have the channel }
        }    
    }    


    /**
     * Attach process's channels according to fresh config
     * 
	 * @param Process
     * @param array $process_channels // config('processes.processes_channels')
	 * @return void
     */
    protected function attachProcessChannels($process, $process_channels) 
    {
        foreach($process_channels as $channel_key) 
        {
            // get the channel with exisiting processes
            $channel = Channel::where('key', $channel_key)->with('processes')->get()->first();
         
            if(!$channel) throw new ProcessorSetterException('Trying to attach undefined channel to process. Run the ChannelsSeeder, then try again. | process_key: ' . $process->key . ' | $channel_key: ' . $channel_key);                

            // check if the process already contains on of the channels in the config 
            if(!$process->channels->contains($channel->id))  
            {
                // if not contain, it's new, attach it now 
                var_dump('+ attaching channel | id: ' . $channel->id . ' | key: ' . $channel->key);

                $process->channels()->attach($channel->id, [
                    Process::LAST_PROCESS => Carbon::now()->subDays($this->process_age_days), 
                    Process::PROCESS_COUNT => 0,
                ]);  

                $this->process_age_days++;
            }                       
        }      
    }
}



