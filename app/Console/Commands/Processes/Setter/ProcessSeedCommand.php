<?php

namespace App\Console\Commands\Processes\Setter;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Setter\ProcessesSetter;



/**
 * Process Seed Command
 * 
 * Handle processes & channels seeding based on processes config
 * 
 * + ProcessSeedCommand 
 * + ProcessAttachChannelsCommand 
 */
class ProcessSeedCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:seed';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed processes channels based on processes config';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        (new ProcessesSetter)->seed(); 
    }
}
