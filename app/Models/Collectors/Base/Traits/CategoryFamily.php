<?php

namespace App\Models\Collectors\Base\Traits;


/**
 * Categories familty trait, generate common categories hirarchy stracture
 */
trait CategoryFamily
{
    /**
     * Get storage category parent 
     * 
     */
    public function parentCategory() 
    {
        return $this->belongsTo(self::class, 
            'parent_category_id',  // use this fk from curr record
            'category_id' // to find parent with the same value in this key
        );
    }
    

    /**
     * Get storage category childrens 
     * 
     */    
    public function childCategories() 
    {
        return $this->hasMany(self::class, 
            'parent_category_id',  // all the children have this fk
            'category_id' // with the value that curr reord has in this local key
        );        
    }  
    
    
    // /**
    //  * Get storage category with it's parent in the channel 
    //  * 
    //  * useage : StorageCategory::withParent($child_id)->first(); 
    //  * 
    //  * @param Builder $query natively injected 
    //  * @param int $child_id child's storage_category.id
    //  * @return void
    //  */
    // public function scopeWithParent($query, $child_id) 
    // {
    //     dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);

    //     // $storage_category = StorageCategory::find($child_id);        

    //     // $query->with(['parent' => function($q) use ($storage_category) {

    //     //     $q->where('channel_id','=', $storage_category->channel_id);

    //     // }])->find($storage_category->id);         
    // }


    // /**
    //  * Get storage category with it's children in the channel 
    //  * 
    //  * useage : StorageCategory::withChildren($parent_id)->first(); 
    //  * 
    //  * @param Builder $query natively injected 
    //  * @param int $parent_id parent's storage_category.id
    //  * @return void
    //  */    
    // public function scopeWithChildren($query, $parent_id) 
    // {
    //     dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);

    //     // $storage_category = StorageCategory::find($parent_id);        

    //     // $query->with(['children' => function($q) use ($storage_category) {

    //     //     $q->where('channel_id','=', $storage_category->channel_id);
            
    //     // }])->find($storage_category->id); 
    // }     
}