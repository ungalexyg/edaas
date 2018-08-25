<?php

namespace App\Console\Commands\Base;

use Illuminate\Console\Command as CoreCommand;


/**
 * Base Command
 */
abstract class BaseCommand extends CoreCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '-'; 


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '-';


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
    abstract public function handle();
}
