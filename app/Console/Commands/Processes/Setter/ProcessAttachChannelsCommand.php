<?php

namespace App\Console\Commands\Processes\Setter;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Setter\ProcessesSetter;



/**
 * Process Attach Command
 * 
 * Attach processes on each channel based on processes config
 */
class ProcessAttachChannelsCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:attach';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attach processes on each channel based on processes config';


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
