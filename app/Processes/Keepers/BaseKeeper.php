<?php 

namespace App\Processes\Keepers;

use App\Models\StorageCategory;
use App\Processes\Traits\HasProcess;


/**
 * Base Keeper
 * 
 * Organise & transform scanned raw data into stactured records which stored in the storage
 */ 
abstract class BaseKeeper implements IKeeper 
{
	/**
	 * Use process traits
	 */
	use HasProcess;

	
	/**
	 * Store fresh scanned data in the storage
	 * 
	 * @return self
	 */
	abstract public function store();	
}



