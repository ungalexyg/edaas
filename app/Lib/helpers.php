<?php

use App\Acts\Base\MainAct as Act;


if (!function_exists('act'))
{
    /**
     * Perform an act using 
     * 
     * This method serves as alternative to repository pattern, which typcally, loads repository with all the actions of an entity in all the scnerios.
     * However, the 'Act' approach split the actions by loading single IAct instance to perform specifc action related to entity. And the entity itself, used just as pointer for classfication.    
     * In short, each method in the repository pattren converted to IAct instance.  
     * 
     * @see App\Acts\Base\MainAct
     * @param string $act App\Enums\Contracts\IActEnum::$act 
     * @return array $response
     */
    function act($act, $params=[])
    {
        return Act::perform($act, $params);
    }
}