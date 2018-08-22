<?php 

namespace App\Processes\Keepers;

use App\Models\StorageCategory;
use App\Processes\Processors\Base\IProcess;


/**
 * Keeper Interface
 */ 
interface IKeeper extends IProcess 
{
	
	/**
	 * Store fresh scanned data in the storage
	 * 
	 * @return self
	 */
	public function store();	
	

	/**
	 * Publish data from the storage to the public tables
	 * 
	 * @return self
	 */
	public static function publish(StorageCategory $storageCategory);

}



