<?php 

namespace App\Processes\Adapters\Aliexpress;

use App\Enums\ChannelEnum as Channels;
use App\Processes\Adapters\Base\BaseAdapter;


/**
 * Base Aliexpress Adapter
 */
 abstract class BaseAliexpressAdapter extends BaseAdapter 
 {
	/**
	 * Channel adapter key
	 * 
	 * @var string
	 */
	protected $key = Channels::ALIEXPRESS;


	/**
	 * Channel adapter primary domain
	 * 
	 * @var string
	 */	
	protected $domain = 'aliexpress.com';


	/**
	 * Fetch targets
	 * 
	 * @param mixed $reference
     * @return mixed
	 */        
	abstract public function fetch($reference=null); 
 }
