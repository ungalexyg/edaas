<?php

namespace App\Console\Commands\Processes\Setter;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Setter\ProcessesSetter;



/**
 * Process Set All Command
 * 
 * Perform process & channels seeding + attachements based on processes config 
 */
class ProcessSetAllCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:set';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set all required actions to operate processes. process:seed + process:attach';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        (new ProcessesSetter)->seed(); 
        (new ProcessesSetter)->setProcessesChannels(); 
    }
}
