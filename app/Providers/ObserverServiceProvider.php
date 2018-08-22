<?php

namespace App\Providers;

use App\Models\StorageCategory;
use Illuminate\Support\ServiceProvider;
use App\Observers\StorageCategoryObserver;


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
