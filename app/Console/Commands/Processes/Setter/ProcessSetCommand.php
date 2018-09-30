<?php

namespace App\Console\Commands\Processes\Setter;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Setter\ProcessesSetter;



/**
 * Process Set Command
 * 
 * Perform processes setter actions
 */
class ProcessSetCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:set {--action=}';  // [seed | attach | migrate | all]

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform processes setter actions --action=[ all | seed | migrate | attach ]';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {           
        $action = $this->option('action');
        
        $setter = (new ProcessesSetter); 

        switch($action) 
        {
            case 'all': 
                $setter->seed(); 
                $setter->attach(); 
                break;                                                            
            case 'seed': 
                $setter->seed(); 
                break;                   
            case 'attach': 
                $setter->attach();             
                break;  
            default:
                $this->error('Undefined action, please use one of the actions in command description');
        }
    }
}
