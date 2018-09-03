<?php

namespace App\Models\Category\Traits;


/**
 * Category Scopes 
 */
trait Scopes
{
    /**
     * Get organic categories
     * 
     * @note: organic categories are categories which have channel category that source it
     * @usage : Category::organic()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeOrganic($query) 
    {
        $query->where('storage_category_id', '!=', null);
    }
    
    
    /**
     * Get organic categories
     * 
     * @note: non organic categories are categories which added manually & have no channel category that source it
     * @usage : Category::nonOrganic()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeNonOrganic($query) 
    {
        $query->where('storage_category_id', '=', null);
    }    


    /**
     * Get main categories
     * 
     * @note: main are categories which have not parents so their parent_category_id marked as 0 for purpose
     * @usage : Category::main()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeMain($query) 
    {
        $query->where('parent_category_id', '=', 0);
    }


    /**
     * Get orphan categories
     * 
     * @note: orphan are categories which their parents not set and they are not the main categories (the parent isn't marked as 0 for purpose) 
     * @usage : Category::orphan()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeOrphan($query) 
    {
        $query->where('parent_category_id', '=', null);
    }    
}
