<?php

namespace App\Console\Commands\Acts;

use App\Enums\Acts;
use App\Acts\Base\MainAct as Act;
use App\Console\Commands\Base\BaseCommand;
use App\Http\Controllers\StorageCategoryController;


/**
 * Activate storage category for items process
 */
class StorageCategoryActivateCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Act:StorageCategory@activate {id}'; // required storage category id 


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate storage category for items process. | {id}';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        //$output = $this->option('output');
        
        $id = $this->argument('id');
        
        $response = (new Act(Acts::ACTIVATE_STORAGE_CATEGORY, ['id' => $id]));
        
        $this->info(print_r($response, 1));  
    }
}
