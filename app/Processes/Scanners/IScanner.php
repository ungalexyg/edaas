<?php 
namespace App\Processes\Scanners;


/**
 * Interface Scanner
 */ 
interface IScanner {
	

    /**
     * Handle process action
     * 
     * @return self
     */
	public function handle();


    /**
     * Perform scaning process
     * 
     * @return self
     */
	public function scan();
}



