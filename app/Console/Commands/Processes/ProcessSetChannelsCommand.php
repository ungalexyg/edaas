<?php

namespace App\Console\Commands\Processes;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Processors\Setter\ProcessesSetter;



/**
 * Process Set Command
 * 
 * Set channels for each process based on processes config
 */
class ProcessSetChannelsCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:set-channels';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set channels for each process based on processes config';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new ProcessesSetter)->setProcessesChannels(); 
    }
}
