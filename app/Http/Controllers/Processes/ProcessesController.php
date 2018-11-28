<?php

namespace App\Http\Controllers\Processes;

use App\Enums\ProcessEnum as Processes;
use App\Models\StorageItem\StorageItem;
use App\Http\Controllers\Base\BaseController;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Channels\Base\MainChannelProcessor as Processor;


/**
 * Processes Controller
 */
class ProcessesController extends BaseController
{
    /**
     * Process channels
     * 
     * @param string $process
     * @param string $channel
     * @return mixed $response
     */
    public function channels($process) 
    {
       $response = (new Processor)->run($process);

       return $response;
    }  
}
