<?php

namespace App\Console\Commands\Processes;

use App\Enums\Processes;
use App\Console\Commands\Base\BaseCommand;
use App\Processes\Processors\Base\MainProcessor as Processor;


/**
 * Process Categories Command
 * 
 * Run the categories process
 */
class ProcessCategoriesCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:categories {--output=message?}'; // output response ['messsage' | 'full']

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the categories process';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $output = $this->option('output');

        $response = (new Processor)->run(Processes::CATEGORIES);
                
        if($output == 'full') 
        {
            $this->info(print_r($response, 1));  
        }
        else
        {
            $this->info($response['message'] ?? 'response message not set');  
        }
    }
}
