<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as CoreController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Base Controller
 */
class BaseController extends CoreController
{
    /**
     * Controller traits
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
