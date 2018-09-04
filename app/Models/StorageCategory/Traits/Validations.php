<?php
namespace App\Models\StorageCategory\Traits;

use App\Exceptions\Models\StorageCategoryException as Exception;


/**
 * Storage Category Validations 
 */
trait Validations
{
    /**
     * Validate publishAll act
     * 
     * @return array
     */
    public function validatePublishAll() 
    {   
        return []; 
    }     


    /**
     * Validate publish act
     * 
     * @return array
     */
    public function validatePublish() 
    {   
        return [
            'id' => 'required|integer'
        ];
    }     


    /**
     * Validate unpublishAll act
     * 
     * @return array
     */
    public function validateUnpublishAll() 
    {   
        return [];
    } 


    /**
     * Validate unpublish act
     * 
     * @return array
     */
    public function validateUnpublish() 
    {   
        return [
            'id' => 'required|integer'
        ];
    }
    
    
    /**
     * Validate activateAll act
     * 
     * @return array
     */
    public function validateActivateAll() 
    {   
        return [];
    } 


    /**
     * Validate activate act
     * 
     * @return array
     */
    public function validateActivate() 
    {   
        return [
            'id' => 'required|integer'
        ];
    } 


    /**
     * Validate deactivateAll act
     * 
     * @return array
     */
    public function validateDeactivateAll() 
    {   
        return [];
    }     
    
    /**
     * Validate deactivate act
     * 
     * @return array
     */
    public function validateDeactivate() 
    {   
        return [
            'id' => 'required|integer'
        ];           
    }      
}
