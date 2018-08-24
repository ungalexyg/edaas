<?php
 /**
 * --------------------------------------------------------------------------
 *  Vendor Extension
 * --------------------------------------------------------------------------
 * Extending vendor component
 * Extension namespace : Illuminate\Support\Facades\Log
 * 
 */

namespace App\Lib\Vendor\Laravel;

use Illuminate\Support\Facades\Log as CoreLog;
use App\Enums\Processes;


/**
 * App Log 
 * 
 * Laravel's Log extension
 */
class Log extends CoreLog
{
    /**
     * Logging channels keyes - categories process 
     */
    const CATEGORIES_PROCESSOR  =  Processes::CATEGORIES . '_processor';
    const CATEGORIES_SCANNER    =  Processes::CATEGORIES . '_scanner';
    const CATEGORIES_ADAPTERS   =  Processes::CATEGORIES . '_adapters';
    const CATEGORIES_KEEPER     =  Processes::CATEGORIES . '_keepers';
    const CATEGORIES_OBSERVER   =  Processes::CATEGORIES . '_observer';
    const CATEGORIES_PUBLISHER  =  Processes::CATEGORIES . '_publisher';


    /**
     * Logging channels keyes - items process 
     */    
    const ITEMS_PROCESSOR       =  Processes::ITEMS . '_processor';
    const ITEMS_SCANNER         =  Processes::ITEMS . '_scanner';    
    const ITEMS_ADAPTERS        =  Processes::ITEMS . '_adapters';
    const ITEMS_KEEPER          =  Processes::ITEMS . '_keepers';
    const ITEMS_OBSERVER        =  Processes::ITEMS . '_observer';
    const ITEMS_PUBLISHER       =  Processes::ITEMS . '_publisher';
}   

