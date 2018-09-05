<?php

namespace App\Models\StorageCategory\Traits\Acts;

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