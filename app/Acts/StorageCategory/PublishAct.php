<?php

namespace App\Acts\StorageCategory;

use App\Enums\Acts;
use App\Models\StorageCategory;
use App\Acts\Base\BaseAct;
use App\Exceptions\Acts\ActException;

/**
 * Publish Storage Category Act
 */
class PublishAct extends BaseAct
{
    /**
     * Execute an Act
     *
     * @return mixed
     */
    public function execute()
    {   
        // if there's a Category with the given storage_category_id, set the rest of the data to the 2nd given array, otherwise create it.
        $category = Category::updateOrCreate(
            [
                'storage_category_id' => $storage_category->id
            ], [
                'title' => $storage_category->title, 
                'description' => $storage_category->description
            ]
        );

        // link the fresh category to the storage_category 
        $storage_category->category_id = $category->id;

        // mark the storage record as published to updated the sourced category with the latest fetched items
        $storage_category->published = 1;

        // mark the storage record as active for items process
        $storage_category->active = (($this->config['auto_active'] ?? false) ? 1 : 0); 

        // save the updates
        $storage_category->save();

        return $category;           
    }
}
