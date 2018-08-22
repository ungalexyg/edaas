<?php

namespace App\Observers;

use App\Models\StorageCategory;
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
        // Mail to admin: new categories added to storage, visit it for confirmation...

        //CategoriesKeeper::publish($storageCategory);
    }

    /**
     * Handle the storage category "updated" event.
     *
     * //TODO: hande confirmation trigger,
     * if $storageCategory->confiremd, update category ... 
     * 
     * 
     * @param  \App\StorageCategory  $storageCategory
     * @return void
     */
    public function updated(StorageCategory $storageCategory)
    {
        //if($storageCategory->confiremd) 
        //{
            CategoriesKeeper::publish($storageCategory);
        //}
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
