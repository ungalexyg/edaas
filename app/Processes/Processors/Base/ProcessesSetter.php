<?php 

namespace App\Processes\Processors\Base;

use App\Models\Channel;
use App\Models\Process;
use Illuminate\Support\Carbon;
use App\Exceptions\ProcessorSetterException;


/**
 * Processor Setter
 * 
 * Handle Processor logistics.
 */ 
class ProcessesSetter  {


	/**
	 * Set channels processes
	 * 
	 * @throws ProcessorSetterException
	 * @return void
	 */
	public function channelsProcesses() 
	{
        $seeds = config('processes.channels_processes');

        $process_age_days = 1;

        foreach($seeds as $channel_key => $config_processes) 
        {
            // get the channel
            $channel = Channel::where('key', $channel_key)->with('processes')->get()->first();
            if(!$channel) throw new ProcessorSetterException('Trying to related process to not existing channel. Run the ChannelsSeeder, then try again. $channel_key:'.$channel_key);

            var_dump('# setting channel_id : '.$channel->id . ' | channel_key : ' . $channel->key . ' ...');

            // - detach previews channel's processes
            foreach($channel->processes as $existing_process) 
            {
                if(!in_array($existing_process->key, $config_processes))  // check if the existing process is still relevant to the channel according to the config
                {                    
                    var_dump('- detaching process_key : ' . $existing_process->key);
                    $channel->processes()->detach($existing_process->id); // if the process not attached to the channel in the current config, detach it now in the db

                } // else { //nothing, the channel already have the process }
                
            }             

            // + attach new channel's processes
            foreach($config_processes as $process_key) 
            {
                $process = Process::where('key', $process_key)->get()->first();
                if(!$process) throw new ProcessorSetterException('Trying to related not existing procssee to channel. Run the ProcessesSeeder, then try again. $channel_key:'.$channel_key . ' | $process_key:' . $process_key); 

                if(!$channel->processes->contains($process->id))  // check if the channel already contains on of the proceses in the config 
                {
                    // if not contain, it's new, attach it now 
                    var_dump('+ attaching process_key : ' . $process->key);
                    $channel->processes()->attach($process->id, [
                        Process::LAST_PROCESS => Carbon::now()->subDays($process_age_days) // dates will be updates after the 1st process, this is just to allow the processor to start 
                    ]);  

                    $process_age_days++;
                }
            }
        }
	} 
}



