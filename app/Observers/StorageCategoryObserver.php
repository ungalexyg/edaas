<?php

 /**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * TODO: write the conditions
 * 
 * TODO: 
 * check Observers:
 * https://medium.com/sammich-shop/simple-record-history-tracking-with-laravel-observers-48a2e3c5698b
 * 
 * 
 */ 


namespace App\Observers;

use Log;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Keepers\CategoriesKeeper;


/**
 * Storage Category Observer
 */
class StorageCategoryObserver
{
    /**
     * Handle to the storage category "created" event.
     *
     * @param App\Models\StorageCategory $storage_category
     * @return void
     */
    public function created(StorageCategory $storage_category)
    {
        Log::channel(Log::CATEGORIES_OBSERVER)->info('observed created storageCategory', [
            'in' => __METHOD__ .':'.__LINE__ , 
            'storage_category' => $storage_category->getAttributes()
        ]);
    }

    /**
     * Handle the storage category "updated" event.
     * 
     * TODO: $storageCategory->confirmed logic ...
     * 
     * @param  App\Models\StorageCategory $storage_category
     * @return void
     */
    public function updated(StorageCategory $storage_category)
    {
        Log::channel(Log::CATEGORIES_OBSERVER)->info('observed updated storageCategory', [
            'in' => __METHOD__ .':'.__LINE__ , 
            'storage_category' => $storage_category->getAttributes()
        ]);
    }

    /**
     * Handle the storage category "deleted" event.
     *
     * @param  App\Models\StorageCategory $storage_category
     * @return void
     */
    // public function deleted(StorageCategory $storage_category)
    // {
    //     //
    // }
}
