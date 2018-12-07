<?php

namespace App\Http\Controllers\Processes;

use App\Http\Controllers\Base\BaseController;
use App\Processes\Base\MainProcessor as Processor;


/**
 * Processes Controller
 */
class ProcessesController extends BaseController
{
    /**
     * Process channels
     * 
     * @param string $process App\Enums\ProcessableEnum::$keys
     * @return mixed $response
     */
    public function process($process) 
    {
       $response = (new Processor)->run($process);

       return $response;
    }  
}
