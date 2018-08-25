<?php

namespace App\Console\Commands\Actions;

use App\Enums\Actions;
use App\Console\Commands\Base\BaseCommand;
use App\Actions\Base\MainAction as Action;


/**
 * Activate storage category for items process
 */
class ActivateStorageCategoryCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:activate_storage_category {id}'; // required storage category id 


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
        
        $response = (new Action)->do(Actions::ACTIVATE_STORAGE_CATEGORY, ['id' => $id]);
        
        $this->info(print_r($response, 1));  
    }
}
