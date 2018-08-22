<?php 

namespace App\Processes\Keepers;

use App\Models\StorageCategory;
use App\Processes\Traits\HasProcess;


/**
 * Base Keeper
 * 
 * The Keeper has 2 functions :
 * 1) Organise & transform scanned raw data into stactured records which stored in the storage
 * 2) Publish the stored data by syncing it from the storage to the published tables
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
	

	/**
	 * Publish data from the storage to the public tables
	 * 
	 * @return self
	 */
	abstract public static function publish(StorageCategory $storageCategory);		
}



