<?php 
namespace App\Processes\Scanners;


/**
 * Interface Scanner
 */ 
interface IScanner {
	

    /**
     * Handle process action
     */
	public function handle();


    /**
     * Perform scaning process
     */
	public function scan();
}



