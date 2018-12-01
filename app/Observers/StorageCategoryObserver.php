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


// namespace App\Observers;

// use Log;
// use App\Models\StorageCategory\StorageCategory;
// use App\Processes\Keepers\CategoriesKeeper;


// /**
//  * Storage Category Observer
//  */
// class StorageCategoryObserver
// {
//     /**
//      * Handle to the storage category "created" event.
//      *
//      * @param App\Models\StorageCategory $storageCategory
//      * @return void
//      */
//     public function created(StorageCategory $storageCategory)
//     {
//         Log::channel(Log::OBSERVER_STORAGE_CATEGORY)->info('observed created storageCategory', [
//             'in' => 'StorageCategoryObserver@:created:'.__LINE__ , 
//             'storageCategory' => $storageCategory->getAttributes()
//         ]);
//     }


//     /**
//      * Handle to the storage category "updating" event.
//      *
//      * @param App\Models\StorageCategory $storageCategory
//      * @return void
//      */
//     public function updating(StorageCategory $storageCategory)
//     {        
//         Log::channel(Log::OBSERVER_STORAGE_CATEGORY)->info('observed updated storageCategory', [
//             'in' => 'StorageCategoryObserver@:updating:'.__LINE__ , 
//             'id' => $storageCategory->id, 
//             'changes' => $storageCategory->getDirty()
//         ]);        
//     }     


//     /**
//      * Handle the storage category "updated" event.
//      * 
//      * @param  App\Models\StorageCategory $storageCategory
//      * @return void
//      */
//     // public function updated(StorageCategory $storageCategory)
//     // {
//     //     Log::channel(Log::OBSERVER_STORAGE_CATEGORY)->info('observed updated storageCategory', [
//     //         'in' => __METHOD__ .':'.__LINE__ , 
//     //         'storage_category' => $storageCategory->getAttributes()
//     //     ]);
//     // }


//     /**
//      * Handle the storage category "deleted" event.
//      *
//      * @param  App\Models\StorageCategory $storageCategory
//      * @return void
//      */
//     // public function deleted(StorageCategory $storageCategory)
//     // {
//     //     //
//     // }


   
// }
