<?php

namespace App\Acts;

use App\Enums\Acts;
use App\Models\StorageCategory;
use App\Acts\Base\BaseAct;
use App\Exceptions\Acts\ActException;

/**
 * Activate storage category Act
 */
class ActivateStorageCategoryAct extends BaseAct
{
    /**
     * Handle Act
     *
     * @return mixed
     */
    public function handle()
    {   
        $id = $this->params['id'] ?? false;

        if(!$id) throw new ActException(ActException::REQUIRED_PARAMS_MISSING . ' | Act: ' . $this->key . ' | missing: id');

        $storage_category = StorageCategory::find($id);

        if(!isset($storage_category->id)) throw new ActException('the StorageCategory record not found for id ' . $id);

        $storage_category->active = 1;

        $storage_category->save();

        $this->message = 'storage category ' . $id . ' activated.';

        return $this;
    }
}
