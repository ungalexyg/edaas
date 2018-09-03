<?php

namespace App\Models\Category;

use App\Models\Base\BaseModel;
use App\Models\Category\Traits\{Relations, Scopes};


/**
 * Category Model
 */
class Category extends BaseModel
{
    /**
     * Model's traits 
     */
    use Relations, Scopes; 


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable
}
