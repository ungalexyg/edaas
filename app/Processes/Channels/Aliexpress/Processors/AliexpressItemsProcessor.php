<?php 

namespace App\Processes\Channels\Aliexpress\Processors;


use App\Processes\Channels\Base\Traits\ChennelProcess;
use App\Processes\Channels\Base\Processors\BaseChannelProcessor;
use App\Models\Collectors\Aliexpress\CAliexpressItem as ItemCollector;
use App\Models\Collectors\Aliexpress\CAliexpressCategory as CategoryCollector;
use App\Processes\Channels\Aliexpress\Adapters\AliexpressItemsAdapter as Adapter;
use App\Processes\Channels\Aliexpress\Exceptions\AliexpressItemsProcessorException as Exception;


/**
 * Aliexpress Items Processor 
 */ 
class AliexpressItemsProcessor extends BaseChannelProcessor
{
    /**
     * Use traits
     */
    use ChennelProcess;


	/**
	 * Category collector instance
	 * 
	 * @var App\Models\Collectors\Aliexpress\CAliexpressCategory
	 */
	protected $categoryCollector;


	/**
	 * Items categories
	 * 
	 * @var array
	 */
	protected $categoires = [];


	/**
	 * Set process specific properties
	 * 
	 * @return self
	 */	
	protected function setSpecifics() 
	{
		$this->categoryCollector  	= new categoryCollector;
        $itemCollector  			= new ItemCollector;
        $adapter    				= new Adapter;   
        $channel    				=& $this->process->processable; 
        $exception  				= Exception::class;     
		
		$this->setChannel($channel);
		$this->setAdapter($adapter);
		$this->setCollector($itemCollector);
        $this->setException($exception); 
        
		return $this;
	}	


	#########################################
	# Implementations 
	#########################################


	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	public function process() 
	{
		$this->setCategories()->scan()->store(); 

		return $this;
	}


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan() 
	{
        $this->adapter->setSpider();
		

		foreach($this->categories as $category) 
		{
			$this->bag[$category->id] = $this->adapter->fetch($category);	
		}
		
		$this->logger->info((!empty($this->bag) ? $this->log::BAG_OK : $this->log::BAG_FAILED), ['in' => __METHOD__ .':'.__LINE__]);

		return $this;
	}

    
	/**
	 * Store fresh scanned data 
     * At this stage $this->bag should have the following contents:
     *  
     *   [
	 *		32905725878 => 
	 *		[
	 *			"item_id" => 32905725878
	 *			"title" => "Ulzzang Harajuku hoodies Fashion BTS Kpop Clothes Women Casual Hooded Sweatshirts Pullovers Tops Short Sleeve Hoodie Shirts"
	 *			"path" => "/item/Ulzzang-Harajuku-hoodies-Fashion-BTS-Kpop-Clothes-Women-Casual-Hooded-Sweatshirts-Pullovers-Tops-Short-Sleeve-Hoodie/32905725878.html"
	 *			"img_src" => null
	 *			"price_min" => 7.51
	 *			"price_max" => false
	 *			"orders" => 419
	 *		]
     *      ...
     *   ]
	 * 
     * @return self
	 */
	public function store() 
	{      
		// dd("METHOD NOT IMPLEMENTED", __METHOD__);

        $this->collector::perform('storeBatch', $this->bag);

        $this->logger->info($this->log::DONE, ['in' => __METHOD__ .':'.__LINE__]);

        // Log::channel(Log::PROCESSOR_ITEMS)->info(Log::ACTION_COMPLETED, ['in' => __METHOD__ .':'. __LINE__]);

        // return $this;
	}


    /**
	 * Publish data from the storage 
	 * 
	 * @return self
     */
	public function publish() 
	{
		dd("METHOD NOT IMPLEMENTED", __METHOD__);

		return $this;
	}	
	
	
	#########################################
	# Setters
	#########################################	


	/**
	 * Set categories to scan items from
	 * 
	 * @return self
	 */
	protected function setCategories() 
	{				
		$this->categories = $this->categoryCollector::awakeProcessables()->get();
		
		if(!$this->categories->count()) 
		{
			$this->logger->info(Exception::AWAKE_ENTITIES_NOT_FOUND, ['in' => __METHOD__ .':'.__LINE__]);

			throw new Exception(Exception::AWAKE_ENTITIES_NOT_FOUND);
		} 

		return $this;
	}	
}
