<?php
namespace App\Models\StorageItem\Traits;

//use App\Exceptions\Models\StorageItemException as Exception; 


/**
 * Storage Item Validations 
 * 
 * - Each method should be prefixed with 'validate' - validateMethodName() 
 * - The methods should return relevant validation rules 
 * - When empty array returned it will skip the validations 
 */
trait Validations
{
    /**
     * Validate store batch
     */
    public function validateStoreBatch() 
    {
        return []; // custom rule can be added here
    }


    // /**
    //  * Validate publishAll act
    //  * 
    //  * @return array
    //  */
    // public function validatePublishAll() 
    // {   
    //     return []; 
    // }     


    // /**
    //  * Validate publish act
    //  * 
    //  * @return array
    //  */
    // public function validatePublish() 
    // {   
    //     return [
    //         'id' => 'required|integer'
    //     ];
    // }     


    // /**
    //  * Validate unpublishAll act
    //  * 
    //  * @return array
    //  */
    // public function validateUnpublishAll() 
    // {   
    //     return [];
    // } 


    // /**
    //  * Validate unpublish act
    //  * 
    //  * @return array
    //  */
    // public function validateUnpublish() 
    // {   
    //     return [
    //         'id' => 'required|integer'
    //     ];
    // }
    
    
    // /**
    //  * Validate activateAll act
    //  * 
    //  * @return array
    //  */
    // public function validateActivateAll() 
    // {   
    //     return [];
    // } 


    // /**
    //  * Validate activate act
    //  * 
    //  * @return array
    //  */
    // public function validateActivate() 
    // {   
    //     return [
    //         'id' => 'required|integer'
    //     ];
    // } 


    // /**
    //  * Validate deactivateAll act
    //  * 
    //  * @return array
    //  */
    // public function validateDeactivateAll() 
    // {   
    //     return [];
    // }     
    
    // /**
    //  * Validate deactivate act
    //  * 
    //  * @return array
    //  */
    // public function validateDeactivate() 
    // {   
    //     return [
    //         'id' => 'required|integer'
    //     ];           
    // }       
}
