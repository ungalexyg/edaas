<?php

namespace App\Models\Category;

use App\Models\StorageCategory;
use Illuminate\Database\Eloquent\Model;


/**
 * Category Model
 */
class Category extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [];    
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    /**
     * Connect the Category with the storageCategory
     */
    public function storage()
    {
        return $this->hasOne(StorageCategory::class);
    }


    /**
     * Get parent category 
     */
    public function parent() 
    {
        return $this->belongsTo(StorageCategory::class, 'parent_category_id');
    }

    
    /**
     * Get category childrens 
     */    
    public function children() 
    {
        return $this->hasMany(StorageCategory::class, 'parent_category_id', 'id');        
    }  
    
    
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
