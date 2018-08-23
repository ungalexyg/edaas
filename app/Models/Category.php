<?php

namespace App\Models;

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
}
