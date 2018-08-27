<?php 

namespace App\Enums\Contracts;

use App\Enums\ProcessesEnum as Processes;


/**
 * Logs Enum Interface
 */ 
interface ILogsEnum
{
    /**
     * Logging channels keyes - Acts 
     */
    const ACTS                  =  'acts';


    /**
     * Logging channels keyes - main processor 
     */
    const MAIN_PROCESSOR        =  'main_processor';


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



