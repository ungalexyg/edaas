<?php 
namespace App\Processes\Scanners;

use App\Processes\Processors\Base\IProcess;


/**
 * Interface Scanner
 */ 
interface IScanner extends IProcess 
{
    
    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan();

    
    /**
     * Load adapter
     * 
     * @param string $channel // channel key
     * @return self
     */
	public function loadAdapter($channel);
    
}



