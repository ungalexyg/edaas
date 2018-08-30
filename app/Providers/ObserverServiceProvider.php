<?php

namespace App\Providers;

use App\Models\StorageCategory\StorageCategory;
use Illuminate\Support\ServiceProvider;
use App\Observers\StorageCategory\StorageCategoryObserver;


/**
 * Observer service provider
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        StorageCategory::observe(StorageCategoryObserver::class);
    }

    // /**
    //  * Register any application services.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     //
    // }
}
