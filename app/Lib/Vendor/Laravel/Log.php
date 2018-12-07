<?php

namespace App\Lib\Vendor\Laravel;

use App\Enums\Contracts\ILogEnum;
use Illuminate\Support\Facades\Log as CoreLog;


/**
 * App Log 
 * 
 * Laravel's Log extension
 */
class Log extends CoreLog implements ILogEnum
{

}   


