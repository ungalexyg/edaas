<?php 
namespace App\Processes\Scanners;

use App\Models\Channel;
use App\Models\Process;
use App\Lib\Enums\Processes;
use Illuminate\Support\Carbon;


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
    
        $this->config['min_age'];
        $this->config['max_channels'];

        $process = Process::with('channels')->where('key', $this->process)->first();
        
        # select order by channels_processes.last_process

        //dd($process); 

        // foreach($process->channels as $channel) 
        // {
        //     var_dump($channel->pivot->last_activity);

        //     if($channel->last_activity) 
        //     {
        //         Carbon::now()->subDays(1)->format('Y-m-d');
        //     }
        // }
        

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



