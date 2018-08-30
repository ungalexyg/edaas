<?php

namespace App\Models\StorageCategory\Traits;

use App\Models\Category;


/**
 * Storage Category Validations 
 */
trait Validations
{
    /**
     * Execute act publish
     */
    public function validateActivate() 
    {
        return [
            'id' => 'required|integer'
        ];
    }            
}
