<?php

namespace App\Models\StorageItem\Traits\Acts;

/**
 * Aggregate Storage Item Acts
 */
trait Acts
{
    /**
     * Use model's acts traits
     */
    use Activate, Publish, Store;       
}