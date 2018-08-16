<?php 
namespace App\Processes\Scanners;

use App\Lib\Enums\Processes;
use App\Models\Channel;
use App\Models\Process;


/**
 * Categories Scanner
 */ 
class CategoriesScanner extends BaseScanner {



    /**
     * Handle process action
     * 
     * TODO:
     * 1) get the channels
     * 2) check which should run in terms of timing
     * 3) perform scan on the next in line
     * 4) pass data to keeper
     * 
     * @return self
     */
    public function handle() 
    {
        //dd($this->process);
    
        $process = Process::with('channels')->where('key', $this->process)->first();
        
        //dd($process); 

        foreach($process->channels as $channel) 
        {
            var_dump($channel->pivot->last_activity);

            if($channel->last_activity) 
            {

            }
        }
        

        $this->scan();

        return $this;
    }


    /**
     * Perform scaning process
     * 
     * @return self
     */
    public function scan() 
    {

        // $this->bag = $this->adapter()->fetch();

        echo "Scaning .....";

        $this->processor->bag['scanned'] = 'value1'; 

        return $this;
    }

}



