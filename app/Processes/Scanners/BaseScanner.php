<?php 
/**
 * --------------------------------------------------------------------------
 *  Scanner
 * --------------------------------------------------------------------------
 * 
 * Locat raw data & "Prospect Items" from given "Prospects Channels", 
 * then pass them to the Keeper for forther handling and storage.
 * 
 * Prospects Channels :
 *  start with Ali
 */ 


namespace App\Processes\Scanners;

use App\Processes\Base\BaseProcess;


/**
 * Base Scanner
 */ 
abstract class BaseScanner extends BaseProcess implements IScanner {


    /**
     * Compare if record has changes 
     */
    abstract public function scan();    


}



