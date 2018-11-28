<?php

namespace App\Console\Commands\Processes;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Base\MainProcessor as Processor;

/**
 * Process Run command 
 * Execute a process
 */
class ProcessRunCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:run {process_key}'; 

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute a process';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {                 
        $process_key = $this->argument('process_key');
        
        $response = (new Processor)->run($process_key);

        dd($response);
    }
}
