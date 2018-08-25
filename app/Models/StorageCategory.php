<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;


/**
 * Storage Category Model
 * 
 * TODO: consider split storage per channel
 * e.g: storage_category_aliexpress, storage_category_amazon
 */
class StorageCategory extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storage_categories';    


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
     * Connect the storageCategory with the Category
     */
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    

    /**
     * Get storage category parent 
     * 
     * ! @note  
     * this relation should NOT be used directly since it is based on ids from several channels, 
     * instead, use the local scope scopeWithParent() that based on this relation 
     */
    public function parent() 
    {
        return $this->belongsTo(StorageCategory::class, 
            'parent_channel_category_id',  // use this fk from curr record
            'channel_category_id' // to find parent with the same value in this key
        );
    }
    

    /**
     * Get storage category childrens 
     * 
     * ! @note
     * this relation should NOT be used directly since it is based on ids from several channels, 
     * instead, use the local scope scopeWithChildren() that based on this relation 
     */    
    public function children() 
    {
        return $this->hasMany(StorageCategory::class, 
            'parent_channel_category_id',  // all the children have this fk
            'channel_category_id' // with the value that curr reord has in this local key
        );        
    } 


    /**
     * Get storage category with it's parent in the channel 
     * 
     * useage : StorageCategory::withParent($child_id)->first(); 
     * 
     * @param Builder $query natively injected 
     * @param int $child_id child's storage_category.id
     * @return void
     */
    public function scopeWithParent($query, $child_id) 
    {
        $storage_category = StorageCategory::find($child_id);        

        $query->with(['parent' => function($q) use ($storage_category) {

            $q->where('channel_id','=', $storage_category->channel_id);

        }])->find($storage_category->id);         
    }


    /**
     * Get storage category with it's children in the channel 
     * 
     * useage : StorageCategory::withChildren($parent_id)->first(); 
     * 
     * @param Builder $query natively injected 
     * @param int $parent_id parent's storage_category.id
     * @return void
     */    
    public function scopeWithChildren($query, $parent_id) 
    {
        $storage_category = StorageCategory::find($parent_id);        

        $query->with(['children' => function($q) use ($storage_category) {

            $q->where('channel_id','=', $storage_category->channel_id);
            
        }])->find($storage_category->id); 
    }


    /**
     * Get published storage category records
     * 
     * useage : StorageCategory::published()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopePublished($query) 
    {
        $query->where('published', '=', 1);
    }


    /**
     * Get unpublished storage category records
     * 
     * useage : StorageCategory::unpublished()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnpublished($query) 
    {
        $query->where('published', '=', 0);
    }


    /**
     * Get active storage category records
     * 
     * useage : StorageCategory::active()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeActive($query) 
    {
        $query->where('active', '=', 1);
    }

    /**
     * Get unactive storage category records
     * 
     * useage : StorageCategory::unactive()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnactive($query) 
    {
        $query->where('active', '=', 0);
    }    
}



