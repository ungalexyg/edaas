<?php

namespace App\Actions;

use App\Enums\Actions;
use App\Models\StorageCategory;
use App\Actions\Base\BaseAction;
use App\Exceptions\Actions\ActionException;

/**
 * Activate storage category action
 */
class ActivateStorageCategoryAction extends BaseAction
{
    /**
     * Handle action
     *
     * @return mixed
     */
    public function handle()
    {   
        $id = $this->params['id'] ?? false;

        if(!$id) throw new ActionException(ActionException::REQUIRED_PARAMS_MISSING . ' | action: ' . $this->key . ' | missing: id');

        $storage_category = StorageCategory::find($id);

        if(!isset($storage_category->id)) throw new ActionException('the StorageCategory record not found for id ' . $id);

        $storage_category->active = 1;

        $storage_category->save();

        $this->message = 'storage category ' . $id . ' activated.';

        return $this;
    }
}
