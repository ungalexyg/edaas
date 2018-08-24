<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Processes\Processors\Base\ProcessesSetter;



/**
 * Processes Channels Command
 */
class ProcessesChannelsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'processes:channels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh channels processes relations basedon processes config';

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
