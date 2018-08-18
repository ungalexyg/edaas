<?php 
namespace App\Processes\Scanners;

use App\Processes\Processors\Base\IProcess;


/**
 * Interface Scanner
 */ 
interface IScanner extends IProcess 
{
    
    /**
     * Handle process action
     * 
     * @return self
     */
	public function handle();

    
    /**
     * Load adapter
     * 
     * @param string $channel
     * @return self
     */
	public function loadAdapter($channel);
    
}



