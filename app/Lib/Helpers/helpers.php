<?php

 /**
 * --------------------------------------------------------------------------
 *  Global Helpers
 * --------------------------------------------------------------------------
 * 
 * The helper functions in this file are available everywhere in the app and can be accessed directly. 
 * When adding here new functions, need to keep in mind that this will be loaded 
 * in each request, so, it should contain only functions that used very often in man places.  
 */

use App\Acts\Base\MainAct as Act;


/**
 * Perform an act using 
 * 
 * This method serves as alternative to repository pattern, which typcally, loads repository with all the actions of an entity in all the scnerios.
 * However, the 'Act' approach split the actions by loading single IAct instance to perform specifc action related to entity. And the entity itself, used just as pointer for classfication.    
 * In short, each method in the repository pattren converted to IAct instance.  
 * 
 * @see App\Acts\Base\MainAct
 * @param string $act App\Enums\Contracts\IActEnum::$act 
 * @param array $input
 * @return array $response
 */
function act($act, $input=[])
{
    return Act::perform($act, $input); 
    
    //return Act::perform('model@activate', ['id' => 1]);  //without model instance
    
    //return Act::perform([$model, 'publish'], []); // with model instance
}