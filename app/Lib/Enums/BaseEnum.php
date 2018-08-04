<?php 

namespace App\Lib\Enums;

/**
 * Base Enum
 */ 
class BaseEnum  {

    /**
     * Get class constants
     * 
     * @return void
     */
    public static function getConstants() 
    {
        return (new \ReflectionClass(get_called_class()))->getConstants();
    }

}



