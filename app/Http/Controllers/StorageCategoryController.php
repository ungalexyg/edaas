<?php

namespace App\Http\Controllers;

use App\Enums\Acts;
use App\Enums\Processes;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Acts\Base\MainAct as Act;



class StorageCategoryController extends Controller
{
    /**
     * Perform Act
     */
    public function activate($id) 
    {
        $response = (new Act)->do(Acts::ACTIVATE_STORAGE_CATEGORY, ['id' => $id]);

        dd($response);
    }
}