<?php

namespace App\Models\StorageCategory;


/**
 * Storage Category Interface
 */
interface IStorageCategory 
{
    /**
     * Storage Category Acts
     */
    const ACTIVATE          = 'activate';           // Activate storage category record for items process
    const ACTIVATE_ALL      = 'activate_all';       // Aactivate all inactive storage category records
    
    const DEACTIVATE        = 'deactivate';         // Deactivate storage category record for items process
    const DEACTIVATE_ALL    = 'deactivate_all';     // Deactivate all active storage category records

    const PUBLISH           = 'publish';            // Publish storage category record
    const PUBLISH_ALL       = 'publish_all';        // Publish all storage category records

    const UNPUBLISH         = 'unpublish';          // Unpublish published storage category record
    const UNPUBLISH_ALL     = 'unpublish_all';      // Unpublish all published storage category records
}