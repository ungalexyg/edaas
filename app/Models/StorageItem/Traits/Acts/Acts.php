<?php

namespace App\Models\StorageItem\Traits\Acts;

/**
 * Aggregate Storage Category Acts
 */
trait Acts
{
    /**
     * Use model's acts traits
     */
    use Activate, Publish, Store;       
}