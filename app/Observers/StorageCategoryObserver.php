<?php

namespace App\Observers;

use App\Models\StorageCategory;
use Illuminate\Support\Facades\Log;
use App\Processes\Keepers\CategoriesKeeper;


/**
 * Storage Category Observer
 */
class StorageCategoryObserver
{
    /**
     * Handle to the storage category "created" event.
     *
     * @param  \App\StorageCategory  $storageCategory
     * @return void
     */
    public function created(StorageCategory $storageCategory)
    {
        Log::channel('observers')->info('observed created storageCategory', [
            'location' => __METHOD__ .':'.__LINE__ , 
            '$storageCategory' => $storageCategory->getAttributes()
        ]);

        CategoriesKeeper::publish($storageCategory);
    }

    /**
     * Handle the storage category "updated" event.
     * 
     * TODO: $storageCategory->confirmed logic ...
     * 
     * @param  \App\StorageCategory  $storageCategory
     * @return void
     */
    public function updated(StorageCategory $storageCategory)
    {
        Log::channel('observers')->info('observed updated storageCategory', [
            'location' => __METHOD__ .':'.__LINE__ , 
            '$storageCategory' => $storageCategory->getAttributes()
        ]);

        // if($storageCategory->confirmed) 
        // {
            CategoriesKeeper::publish($storageCategory);
        // }
    }

    /**
     * Handle the storage category "deleted" event.
     *
     * @param  \App\StorageCategory  $storageCategory
     * @return void
     */
    public function deleted(StorageCategory $storageCategory)
    {
        //
    }
}
