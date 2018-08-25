<?php

namespace App\Http\Controllers;

use App\Enums\Actions;
use App\Enums\Processes;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Actions\Base\MainAction as Action;



class StorageCategoryController extends Controller
{
    /**
     * Perform action
     */
    public function activate($id) 
    {
        $response = (new Action)->do(Actions::ACTIVATE_STORAGE_CATEGORY, ['id' => $id]);

        dd($response);
    }
}