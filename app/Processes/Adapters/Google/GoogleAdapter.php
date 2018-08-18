<?php

namespace App\Processes\Adapters\Google;

use App\Processes\Adapters\Base\BaseAdapter;
use App\Processes\Adapters\Google\Traits\GCustomSearch;
use App\Processes\Adapters\Google\Traits\GReverseImage;


 /**
  * Google Adapter
  */
 class GoogleAdapter extends BaseAdapter 
 {

    /**
	 * Use google custom search
	 * Use google reverse image search
	 */
	use GCustomSearch, GReverseImage;

 }