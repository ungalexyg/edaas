<?php 

namespace App\Enums\Contracts;


/**
 * Logs Enum Interface
 * 
 * Holds logging channels keyes per component
 */ 
interface ILogEnum
{
    /**
     * Models channels
     */
    const STORAGE_CATEGORY              =  'storage_category';

    
    /**
     * Processors channels 
     */
    const PROCESSOR_MAIN                =  'processor_main';    
    const PROCESSOR_CATEGORIES          =  'processor_categories';
    const PROCESSOR_ITEMS               =  'processor_items';
    

    /**
     * Adapters channels
     */    
    const ADAPTERS_CATEGORIES           =  'adapters_categories';    
    const ADAPTERS_ITEMS                =  'adapters_items';


    /**
     * Observers channels
     */
    const OBSERVER_STORAGE_CATEGORY     =  'observer_storage_category';
}
