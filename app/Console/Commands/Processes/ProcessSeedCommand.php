<?php

namespace App\Console\Commands\Processes;

use App\Console\Commands\Base\BaseCommand;
use App\Processes\Seeder\ProcessesSeeder;


/**
 * Process Set Command
 * 
 * Perform processes setter actions
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
    protected $description = 'Seed & attach processes with prossesable entities';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {                   
        (new ProcessesSeeder)->seed();
    }
}
