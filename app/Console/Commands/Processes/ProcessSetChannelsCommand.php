<?php

namespace App\Console\Commands\Processes;

use Illuminate\Console\Command;
use App\Processes\Processors\Setter\ProcessesSetter;



/**
 * Process Set Command
 * 
 * Set channels for each process based on processes config
 */
class ProcessSetChannelsCommand extends Command
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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
