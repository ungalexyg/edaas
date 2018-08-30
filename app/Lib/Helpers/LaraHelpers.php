<?php

namespace App\Lib\Helpers;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Lara Helpers
 * Speific helpers related to laravel
 */
class LaraHelpers 
{
    /**
     * Check if given class path or initiated instance are Eloquent models
     * 
     * The class can be in few formants : 
     * - Category::class 
     * - App\Model\Category 
     * - $class = (new Category)
     * 
     * all of these will return true if it sub calss of Eloquent 
     * 
     * @param string|object $class 
     * @return bool
     */
    public static function isEloquent($class)
    {
        return is_subclass_of($class, Eloquent::class); 
    }  
    

    /**
     * Check if instance is Eloquent instance
     * 
     * The $instance must be 
     * $instance = (new Category)
     * otherwise, it will return false
     * 
     * @param object $instance e.g: 
     * @return bool
     */
    public static function isEloquentInstance($instance)
    {
        return ($instance instanceof Eloquent) ? true : false;
    }      
}   


